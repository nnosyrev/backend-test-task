<?php

namespace Raketa\BackendTestTask\Controller;

use Psr\Http\Message\RequestInterface;
use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Domain\CartItem;
use Raketa\BackendTestTask\Service\CartManager;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

readonly class CartController
{
    public function __construct(
        private ProductRepository $productRepository,
        private CartManager $cartManager,
        private SerializerInterface $serializer
    ) {
    }

    public function сart(string $clientHash): JsonResponse
    {
        $cart = $this->cartManager->getCart($clientHash);

        if (!$cart) {
            $cart = Cart::createEmpty();
        }

        $json = $this->serializer->serialize($cart, 'json');

        return JsonResponse::fromJsonString($json, 200);
    }

    public function update(RequestInterface $request, string $clientHash): JsonResponse
    {
        $rawRequest = json_decode($request->getBody()->getContents(), true);

        $product = $this->productRepository->findOneByUuidOrFail($rawRequest['productUuid']);
        $quantity = $rawRequest['quantity'];

        $cart = $this->cartManager->getCart($clientHash);
        if (!$cart) {
            $cart = Cart::createEmpty();
        }

        $cart->addItem(
            new CartItem($product->getUuid(), $quantity)
        );

        $this->cartManager->saveCart($clientHash, $cart);

        $json = $this->serializer->serialize($cart, 'json');

        return JsonResponse::fromJsonString($json, 200);
    }
}
