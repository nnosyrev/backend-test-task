<?php

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Domain\CartItem;
use Raketa\BackendTestTask\Service\CartStorage\CartStorageInterface;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class CartController
{
    public function __construct(
        private ProductRepository $productRepository,
        private CartStorageInterface $cartStorage,
        private SerializerInterface $serializer
    ) {
    }

    public function сart(string $clientHash): JsonResponse
    {
        $cart = $this->cartStorage->get($clientHash);

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

        $cart = $this->cartStorage->get($clientHash);
        if (!$cart) {
            $cart = Cart::createEmpty();
        }

        $cart->addItem(
            new CartItem($product->getUuid(), $quantity)
        );

        $this->cartStorage->save($clientHash, $cart);

        $json = $this->serializer->serialize($cart, 'json');

        return JsonResponse::fromJsonString($json, 200);
    }
}
