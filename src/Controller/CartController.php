<?php

namespace Raketa\BackendTestTask\Controller;

use Psr\Http\Message\RequestInterface;
use Raketa\BackendTestTask\Domain\CartItem;
use Raketa\BackendTestTask\Service\CartManager;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Raketa\BackendTestTask\View\CartView;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

readonly class CartController
{
    public function __construct(
        private ProductRepository $productRepository,
        private CartView $cartView,
        private CartManager $cartManager,
    ) {
    }

    public function сart(string $clientHash): JsonResponse
    {
        $cart = $this->cartManager->getCart($clientHash);

        if (!$cart) {
            return new JsonResponse(['message' => 'Cart not found'], 404);
        }

        return new JsonResponse($this->cartView->toArray($cart), 200);
    }

    public function update(RequestInterface $request, string $clientHash): JsonResponse
    {
        $rawRequest = json_decode($request->getBody()->getContents(), true);
        $product = $this->productRepository->findOneByUuidOrFail($rawRequest['productUuid']);

        $cart = $this->cartManager->getCart($clientHash);
        $cart->addItem(new CartItem(
            Uuid::uuid4()->toString(),
            $product->getUuid(),
            $product->getPrice(),
            $rawRequest['quantity'],
        ));

        $data = [
            'status' => 'success',
            'cart' => $this->cartView->toArray($cart)
        ];

        return new JsonResponse($data, 200);
    }
}
