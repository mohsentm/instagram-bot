<?php

namespace App\Console\Commands\InstagramAccountCommand;

use App\Rules\InstagramRule\InstagramAccountStatusCheck;
use App\Services\ControllersService\InstagramAccountService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class AddAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:add {--username=} {--password=} {--status=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add instagram account';

    private $accountService;
    private $registerInstagramAccount;

    public function __construct(
        InstagramAccountService $accountService
    )
    {
        parent::__construct();

        $this->accountService = $accountService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
//        var_dump( $this->validateParameter($this->option()));die;
//        $parameter = [
//            'username'=> $this->option(),
//           'password'=>,
//           'status'=>,
//        ]
        if($this->validateParameter($this->option())) {
            $this->accountService->register($this->option());
        }
    }

    private function validateParameter(array $data)
    {
        $validator = Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:instagram_accounts'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['string', new InstagramAccountStatusCheck()]
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $parameter => $errors) {
                $this->printError($parameter.':');
                foreach ($errors as  $error) {
                    $this->printError('- '.$error);
                }
            }
            return false;
        }

        return true;
    }

    private function printError(string $message): void
    {
        $this->line('<fg=red>' .$message.'</>');
    }
}
