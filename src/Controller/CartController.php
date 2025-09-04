<?php

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Domain\CartItem;
use Raketa\BackendTestTask\Service\CartManager;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

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

    public function update(Request $request, string $clientHash): JsonResponse
    {
        $productUuid = $request->request->get('productUuid');
        $quantity = $request->request->get('quantity');

        $product = $this->productRepository->findOneByUuidOrFail($productUuid);

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
