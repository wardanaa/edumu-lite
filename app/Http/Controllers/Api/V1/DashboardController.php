<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\DashboardRequest;
use App\Models\Customer;
use App\Repositories\Api\V1\ContentRepository;
use App\Repositories\Api\V1\CustomerRepository;

class DashboardController extends ApiController {

    const TYPE_SLIDER = 1;
    const TYPE_GREETINGS = 2;
    const TYPE_COUNTER = 3;
    const TYPE_ANNOUNCEMENTS = 4;

    /** @var ContentRepository */
    protected $contentRepository;

    /** @var CustomerRepository */
    protected $customerRepository;

    /**
     * DashboardController constructor.
     * @param ContentRepository $contentRepository
     * @param CustomerRepository $customerRepository
     */
    public function __construct(ContentRepository $contentRepository, CustomerRepository $customerRepository) {
        $this->contentRepository  = $contentRepository;
        $this->customerRepository = $customerRepository;
    }

    public function index(DashboardRequest $request) {
        $item_type = [];
        $regId = $request->input('reg_id');
        $token = $request->bearerToken();
        if (!empty($regId)){
            /** @var Customer $customer */
            $customer = Customer::where('api_token', $token)->first();
            if ($customer){
                $customer->reg_id = $regId;
                $customer->save();
            }
        }

//         SLIDER
        $data         = [];
        $data['type'] = self::TYPE_SLIDER;
        $contents     = $this->contentRepository->getContentNews();
        if (count($contents)) {
            foreach ($contents as $content){
                $content->image = $content->image_location;
            }
            $data['content'] = $contents;
            array_push($item_type, $data);
        }

        // GREETINGS
        $data         = [];
        $data['type'] = self::TYPE_GREETINGS;
        $data['todo'] = null;
        array_push($item_type, $data);

        // COUNTER
        $data            = [];
        $data['type']    = self::TYPE_COUNTER;
        $data['counter'] = [
            'content' => $this->contentRepository->countContentActive(),
            'contributor' => $this->customerRepository->countActive(),
        ];
        array_push($item_type, $data);

        // ANNOUNCEMENT
        $data         = [];
        $data['type'] = self::TYPE_ANNOUNCEMENTS;
        $contents     = $this->contentRepository->getContentNew();
        if (count($contents)) {
            $data['content'] = $contents;
            array_push($item_type, $data);
        }


        $this->data = ['item_type' => $item_type];

        $this->status = true;
        return $this->api_response();
    }
}