<?php

namespace App\Domain\Service\Commands;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Domain\Service\Queries\GetServiceByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Service;
use App\ServiceTab;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateServiceCommand
 * @package App\Domain\Service\Commands
 */
class UpdateServiceCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateServiceCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $service = $this->dispatch(new GetServiceByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($service->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($service->getOriginal('alias'), $urlNew, 'service.show'));
        }

        if ($this->request->has('image')) {
            if ($service->image) {
                $this->dispatch(new DeleteImageCommand($service->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $service->id, Service::class));
        }

        $service->relativeServices()->sync($this->request->post('services'));
        $this->syncTabs();

        return $service->update($this->request->all());
    }

    private function syncTabs(): void
    {
        if ($this->request->post('tabs')) {
            ServiceTab::where('service_id', $this->id)->delete();
            foreach ($this->request->post('tabs') as $key => $value) {
                if ($value) {
                    ServiceTab::create([
                        'service_id' => $this->id,
                        'tab_id' => intval($key),
                        'value' => (string)$value
                    ]);
                }
            }
        }
    }

}