<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Service;

use Exception;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Infrastructure\ConnectorFacade;

class CartManager extends ConnectorFacade
{
    public $logger;

    public function __construct($host, $port, $password)
    {
        parent::__construct($host, $port, $password, 1);
        parent::build();
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function saveCart(string $clientHash, Cart $cart)
    {
        try {
            $this->connector->set($clientHash, $cart);
        } catch (Exception $e) {
            $this->logger->error('Error');
        }
    }

    /**
     * @return ?Cart
     */
    public function getCart(string $clientHash)
    {
        try {
            return $this->connector->get($clientHash);
        } catch (Exception $e) {
            $this->logger->error('Error');
        }

        return new Cart($clientHash, []);
    }
}
