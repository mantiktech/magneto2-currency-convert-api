<?php
declare(strict_types=1);

namespace Mantik\CurrencyConvertapi\Model\Currency\Import;

use Magento\Directory\Model\Currency\Import\AbstractImport;
use Magento\Directory\Model\CurrencyFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\LaminasClientFactory as HttpClientFactory;
use Magento\Store\Model\ScopeInterface;
use Laminas\Http\Request;

class MantikCurrencyApi extends AbstractImport
{
    private ScopeConfigInterface $scopeConfig;
    /**
     * @var \Magento\Framework\HTTP\LaminasClientFactory
     */
    private $httpClientFactory;

    public function __construct(
        CurrencyFactory $currencyFactory,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\HTTP\LaminasClientFactory $httpClientFactory
    ) {
        parent::__construct($currencyFactory);
        $this->scopeConfig = $scopeConfig;
        $this->httpClientFactory = $httpClientFactory;
    }

    
        protected function _convert($currencyFrom, $currencyTo)
    {
        if (($currencyFrom === $currencyTo) || ($currencyTo !== 'ARS' || $currencyFrom !== 'USD')) {
            return null;
        }

        $apiUrl = (string)$this->scopeConfig->getValue('currency/currencyconvertapi/api_url', ScopeInterface::SCOPE_STORE);
        $jsonName = (string)$this->scopeConfig->getValue('currency/currencyconvertapi/json_name', ScopeInterface::SCOPE_STORE);
        $jsonName = $jsonName !== '' ? $jsonName : 'rates';
        $fixedAmount = (float)$this->scopeConfig->getValue('currency/currencyconvertapi/add_fixed_amount', ScopeInterface::SCOPE_STORE);

        if ($apiUrl === '') {
            $this->_messages[] = __('API URL is not configured.');
            return null;
        }

        $url = $apiUrl;

      

        $httpClient = $this->httpClientFactory->create();
        $httpClient->setUri($url);
        $httpClient->setMethod(Request::METHOD_GET);

        $json = '';
        try {
            $json = $httpClient->send()->getBody();
        } catch (\Exception $e) {
            $this->_messages[] = __('Currency rates can\'t be retrieved.');
            return null;
        }

        $response = json_decode($json, true);
        
        if (!is_array($response) || !isset($response[$jsonName])) {
            $this->_messages[] = __('Invalid response format.');
            return null;
        }

        $rates = $response[$jsonName];
  

        $rate = (float)$rates;
        if ($fixedAmount !== 0.0) {
            $rate += $fixedAmount;
        }
        return  $rate;
        
    }
}