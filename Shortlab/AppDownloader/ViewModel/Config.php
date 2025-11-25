<?php
declare(strict_types=1);

namespace Shortlab\AppDownloader\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config implements ArgumentInterface
{
    private const XML_PATH = 'shortlab_appdownloader/general/';

    public function __construct(
        private ScopeConfigInterface $scopeConfig,
        private StoreManagerInterface $storeManager
    ) {}

    private function getConfig(string $field): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH . $field,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function isEnabled(): bool
    {
        return $this->getConfig('enabled') === '1';
    }

    public function getLogoUrl(): ?string
    {
        $path = $this->getConfig('app_logo'); // хранится что-то вроде default/logo.png

        if (!$path) {
            return null;
        }

        // Если путь уже содержит папку shortlab/appdownloader/logo, то просто добавляем к media
        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
            . 'shortlab/appdownloader/logo/' . ltrim($path, '/');
    }

    public function isGeneric(): bool
    {
        return $this->getConfig('use_generic') === '1';
    }

    public function getGenericLink(): string
    {
        return $this->getConfig('generic_link');
    }

    public function getGooglePlayLink(): string
    {
        return $this->getConfig('google_play');
    }

    public function getAppStoreLink(): string
    {
        return $this->getConfig('app_store');
    }

    public function getButtonText(): string
    {
        return $this->getConfig('button_text');
    }

    public function getDescription(): string
    {
        return $this->getConfig('description');
    }
}
