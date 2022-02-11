<?php

namespace Quimaira\Theme\Http\Controllers;

use Webkul\ImageGallery\Models\ManageGallery;
use Webkul\ImageGallery\Repositories\ImageGalleryRepository;
use Webkul\ImageGallery\Repositories\ManageGalleryRepository;
use Webkul\ImageGallery\Repositories\ManageGroupRepository;

class PagesController extends Controller
{
    protected $_config;
    protected $imageGalleryRepository;

    public function __construct(
        ImageGalleryRepository $imageGalleryRepository,
        ManageGalleryRepository $manageGalleryRepository,
        ManageGroupRepository $manageGroupRepository
    ) {
        $this->imageGalleryRepository = $imageGalleryRepository;
        $this->manageGalleryRepository = $manageGalleryRepository;
        $this->manageGroupRepository = $manageGroupRepository;


        $this->_config = request('_config');
    }


    public function pages()
    {
        return view($this->_config['view']);
    }

    public function looks()
    {
        $galery = current(current($this->manageGalleryRepository->getCategoryTreeForShopImage(1)));
        $galery->image_name = $this->imageGalleryRepository->getCategoryTreeForShop($galery->image_ids);

        return view($this->_config['view'], compact('galery'));
    }
}
