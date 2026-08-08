<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use App\Services\TranslationService;

#[Title('Languages Management')]
class Languages extends Component
{
    public $languages = [];
    public $selectedLang = 'en';
    public $files = [];
    public $selectedFile = '';
    public $translations = [];
    public $newLangCode = '';
    public $isTranslating = false;

    public function mount()
    {
        $this->loadLanguages();
        $this->loadFiles();
    }

    public function loadLanguages()
    {
        $this->languages = ['en'];
        if (File::exists(lang_path())) {
            foreach (File::directories(lang_path()) as $dir) {
                $lang = basename($dir);
                if (strlen($lang) <= 5 && !in_array($lang, $this->languages)) {
                    $this->languages[] = $lang;
                }
            }
        }
        sort($this->languages);
    }

    public function updatedSelectedLang()
    {
        $this->loadFiles();
        $this->selectedFile = '';
        $this->translations = [];
    }

    public function loadFiles()
    {
        $path = lang_path($this->selectedLang);
        $files = [];

        if (File::exists($path) && File::isDirectory($path)) {
            $allFiles = File::allFiles($path);
            foreach ($allFiles as $file) {
                $relativePath = $file->getRelativePathname();
                $files[] = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
            }
        }

        // Sort files: General ones first, then modular ones
        sort($files);

        $jsonFile = "{$this->selectedLang}.json";
        if (File::exists(lang_path($jsonFile))) {
            $files[] = $jsonFile;
        }

        $this->files = $files;
    }

    public function updatedSelectedFile()
    {
        if (!$this->selectedFile) {
            $this->translations = [];
            return;
        }

        $this->translations = [];

        try {
            if (str_ends_with($this->selectedFile, '.json')) {
                $path = lang_path($this->selectedFile);
                if (File::exists($path)) {
                    $this->translations = json_decode(File::get($path), true) ?? [];
                }
            } else {
                $path = lang_path("{$this->selectedLang}/{$this->selectedFile}");
                if (File::exists($path)) {
                    $this->translations = File::getRequire($path);
                    if (!is_array($this->translations)) $this->translations = [];
                }
            }
        } catch (\Throwable $e) {
            $this->dispatch('toast', message: 'Could not load file: ' . $e->getMessage(), type: 'error');
        }
    }

    public function addLanguage(TranslationService $service)
    {
        $this->validate([
            'newLangCode' => 'required|alpha|min:2|max:5'
        ]);

        $newCode = strtolower($this->newLangCode);
        $newPath = lang_path($newCode);
        $enPath = lang_path('en');

        if (File::exists($newPath)) {
            $this->dispatch('toast', ['message' => 'Language already exists!', 'type' => 'error']);
            return;
        }

        $this->isTranslating = true;

        File::makeDirectory($newPath, 0755, true);
        $this->sync($newCode, $service);

        $this->loadLanguages();
        $this->newLangCode = '';
        $this->isTranslating = false;

        $this->dispatch('toast', [
            'message' => "Language $newCode added and AUTO-TRANSLATED!",
            'type' => 'success'
        ]);
    }

    public function sync($lang, TranslationService $service)
    {
        $this->isTranslating = true;
        $enPath = lang_path('en');
        $targetPath = lang_path($lang);

        if (!File::exists($targetPath)) {
            File::makeDirectory($targetPath, 0755, true);
        }

        // 1. Sync PHP files (Recursive)
        if (File::isDirectory($enPath)) {
            $enFiles = File::allFiles($enPath);
            foreach ($enFiles as $file) {
                $relativePath = $file->getRelativePathname();
                $targetFile = $targetPath . DIRECTORY_SEPARATOR . $relativePath;

                if (!File::exists(dirname($targetFile))) {
                    File::makeDirectory(dirname($targetFile), 0755, true);
                }

                if (!File::exists($targetFile)) {
                    try {
                        $content = File::getRequire($file->getPathname());
                        if (is_array($content)) {
                            $translated = $service->translate($content, $lang, 'en');

                            $phpContent = "<?php\n\nreturn " . var_export($translated, true) . ";\n";
                            $phpContent = str_replace(['array (', ')'], ['[', ']'], $phpContent);

                            File::put($targetFile, $phpContent);
                        }
                    } catch (\Throwable $e) {
                        continue;
                    }
                }
            }
        }

        // 2. Sync JSON file
        $enJson = lang_path('en.json');
        $targetJson = lang_path("{$lang}.json");
        if (File::exists($enJson) && !File::exists($targetJson)) {
            try {
                $content = json_decode(File::get($enJson), true);
                if (is_array($content)) {
                    $translated = $service->translate($content, $lang, 'en');
                    File::put($targetJson, json_encode($translated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
            } catch (\Throwable $e) {}
        }

        $this->isTranslating = false;
        $this->dispatch('toast', ['message' => "Language $lang synced with English!", 'type' => 'success']);
        $this->loadFiles();
    }

    public function saveTranslations()
    {
        if (!$this->selectedFile) return;

        try {
            if (str_ends_with($this->selectedFile, '.json')) {
                $path = lang_path($this->selectedFile);
                File::put($path, json_encode($this->translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            } else {
                $path = lang_path("{$this->selectedLang}/{$this->selectedFile}");

                if (!File::exists(dirname($path))) {
                    File::makeDirectory(dirname($path), 0755, true);
                }

                $content = "<?php\n\nreturn " . var_export($this->translations, true) . ";\n";
                $content = str_replace(['array (', ')'], ['[', ']'], $content);
                File::put($path, $content);
            }

            $this->dispatch('toast', message: 'Translations saved successfully!', type: 'success');
        } catch (\Throwable $e) {
            $this->dispatch('toast', message: 'Error saving translations: ' . $e->getMessage(), type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.languages')->layout('components.layouts.app');
    }
}
