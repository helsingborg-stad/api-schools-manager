<?php

// phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
class PackageVersionManager
{
    private const PACKAGE_JSON_FILE  = 'package.json';
    private const COMPOSER_JSON_FILE = 'composer.json';
    private string $version;
    private ?string $wordPressPluginFile;

    public function __construct(string $version)
    {
        $this->version             = $version;
        $this->wordPressPluginFile = $this->getWordPressPluginFile();
    }

    public function updatePackageFiles()
    {
        if ($this->isPackageJsonFilePresent()) {
            $this->updatePackageJsonVersion($this->version);
        }

        if ($this->isComposerJsonFilePresent()) {
            $this->updateComposerJsonVersion($this->version);
        }

        if ($this->wordPressPluginFile !== null) {
            $this->updateWordPressPluginVersion($this->version);
        }
    }

    private function isPackageJsonFilePresent(): bool
    {
        return file_exists('package.json');
    }

    private function updatePackageJsonVersion(string $version)
    {
        $packageJson            = json_decode(file_get_contents(self::PACKAGE_JSON_FILE), true);
        $packageJson['version'] = $version;
        file_put_contents(self::PACKAGE_JSON_FILE, json_encode($packageJson, JSON_PRETTY_PRINT));
        exec('npm update --package-lock-only');
        print "Updated package.json version to $this->version\n";
    }

    private function isComposerJsonFilePresent(): bool
    {
        return file_exists('composer.json');
    }

    private function updateComposerJsonVersion(string $version)
    {
        $composerJson            = json_decode(file_get_contents(self::COMPOSER_JSON_FILE), true);
        $composerJson['version'] = $version;
        file_put_contents(self::COMPOSER_JSON_FILE, json_encode($composerJson, JSON_PRETTY_PRINT));
        exec('composer update --lock');
        print "Updated composer.json version to $this->version\n";
    }

    private function getWordPressPluginFile(): string|null
    {
        $pluginFiles = glob('./*.php');
        foreach ($pluginFiles as $pluginFile) {
            $pluginFileContents = file_get_contents($pluginFile);
            $thisFile           = "./" . basename(__FILE__);
            if (preg_match('/\* Plugin Name: (.*)/', $pluginFileContents, $matches) && $pluginFile !== $thisFile) {
                return $pluginFile;
            }
        }

        return null;
    }

    private function updateWordPressPluginVersion(string $version)
    {
        $pluginFileContents = file_get_contents($this->wordPressPluginFile);
        $pluginFileContents = preg_replace('/Version: (.*)/', "Version: $version", $pluginFileContents);
        file_put_contents($this->wordPressPluginFile, $pluginFileContents);
        print "Updated $this->wordPressPluginFile version to $this->version\n";
    }
}
