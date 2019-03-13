<?php

namespace App\Domain\Guestbook\Commands;

use App\Guestbook;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateGuestbookCommand
 * @package App\Domain\Guestbook\Commands
 */
class CreateGuestbookCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateGuestbookCommand constructor.
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
        $guestbook = new Guestbook();
        $guestbook->fill($this->request->all());
        $guestbook->fill(['published_at' => date('Y-m-d')]);

        return $guestbook->save();
    }

}
