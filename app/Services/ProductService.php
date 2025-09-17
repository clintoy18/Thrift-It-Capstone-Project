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

    public function createProduct(array $data, $image = null)
    {
        // Add business logic here if needed
        if ($image) {
            $data['image'] = $image->store('products_images', 'public');
        }
        return $this->productRepository->create($data);
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

    public function getApprovedProductsBySegment(Segment $segment)
    {
        return $this->productRepository->getApproveProducts($segment);
    }

    public function getProductsByStatusPaginated(string $status, int $perPage = 10)
    {
        return $this->productRepository->getByStatusPaginated($status, $perPage);
    }


}
