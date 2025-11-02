<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Models\Segment;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductsByUser($userId)
    {
        return $this->productRepository->getByUser($userId);
    }

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function getProductWithRelations($id)
    {
        return $this->productRepository->findWithRelations($id);
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

   public function createProduct(array $data, ?array $images = null)
    {
        // 1️⃣ Create the product first (without images)
        $product = $this->productRepository->create($data);

        // 2️⃣ If images are uploaded, store them in product_images table
        if ($images && count($images) > 0) {
            foreach ($images as $image) {
                // Store image in storage/app/public/items_images
                $path = $image->store('items_images', 'public');

                // Save record in images table
                $product->images()->create([
                    'image' => $path, // Make sure your column is named 'filename' or adjust accordingly
                ]);
            }
        }

        return $product;
    }


    public function updateProduct(Product $product, array $data, $image = null)
    {
        // Add business logic here if needed
        if($image){
            //Delete old image if exists
            if($product->image){
                Storage::delete('public/'.$product->image);
            }
            $data['image'] = $image->store('products_images', 'public');
        }
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product)
    {
        // Add business logic here if needed
        return $this->productRepository->delete($product);
    }

    public function getApprovedProductsBySegment(Segment $segment, ?int $categoryId = null, ?int $barangayId = null)
    {
        return $this->productRepository->getApproveProducts($segment, $categoryId, $barangayId);
    }

    public function getProductsByStatusPaginated(string $status, int $perPage = 10)
    {
        return $this->productRepository->getByStatusPaginated($status, $perPage);
    }

    public function getMoreProductsByUser($userId, $excludeProductId, $limit = 6)
    {
        return $this->productRepository->getMoreByUser($userId, $excludeProductId, $limit);
    }



}
