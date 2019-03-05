<?php

namespace App\Domain\Service\Commands;

use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Service;
use App\ServiceTab;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateServiceCommand
 * @package App\Domain\Service\Commands
 */
class CreateServiceCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateServiceCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $service = new Service();
        $service->fill($this->request->all());
        $service->save();

        if($this->request->has('image')) {
            $this->dispatch(new UploadImageCommand($this->request, $service->id, Service::class));
        }

        $service->relativeServices()->attach($this->request->post('services'));
        $this->attachTabs($service);

        return true;
    }

    /**
     * @param Service $service
     */
    private function attachTabs(Service $service): void
    {
        if ($this->request->post('tabs')) {
            foreach ($this->request->post('tabs') as $key => $value) {
                if ($value) {
                    ServiceTab::create([
                        'service_id' => $service->id,
                        'tab_id' => intval($key),
                        'value' => (string)$value
                    ]);
                }
            }
        }
    }

}