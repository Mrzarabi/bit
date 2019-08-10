<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    // Return random value in given range
    public function getCount($label = 'Data')
    {
        $count = $this->command->ask("How many {$label} do you need ?", 'radnom between 1 and 10');
        
        if ( $count === 'radnom between 1 and 10' ) 
            return rand(1, 10);

        return $count;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many genres you need, defaulting 1 to 10
        $userCount = $this->getCount('users');

        $this->command->info("Creating {$userCount} users.");

        // Create the Users 
        $users = factory(App\User::class, $userCount)->create();

        // How many genres you need, defaulting 1 to 10
        $ticketCount = $this->getCount('tickets');

        $this->command->info("Creating {$ticketCount} Tickets.");

        // Create the Tickets & relateion User
        $tickets = factory(App\Models\Ticket\Ticket::class, $ticketCount)->create([
            'user_id' => $users->random()->id
        ]);

        // How many genres you need, defaulting 1 to 10
        $ticketmessageCount = $this->getCount('ticketMessages');

        $this->command->info("Creating {$ticketmessageCount} Ticket Messages.");

        // Create the Ticket Messages & relation User & Ticket
        $tickets->each(function($ticket) use($users, $ticketmessageCount) 
        {
            //For using all memory limit
            ini_set('memory_limit', '-1');
            
            $ticket->ticketmessages()->saveMany(
                factory(App\Models\Ticket\TicketMessage::class, $ticketmessageCount)->make([
                    'user_id' => $users->random()->id,
                    'ticket_id' => $ticket->id
                ])
            );
        });

        // How many genres you need, defaulting 1 to 10
        $bankCardCount = $this->getCount('bankCards');
        
        $this->command->info("Creating {$bankCardCount} Bank Cards.");

        // Create the Bank card & relation User
        $bank_card = factory(App\Models\Bank\BankCard::class, $bankCardCount)->create([
            'user_id' => $users->random()->id
        ]);

        $this->command->info("Users , Tickets , Ticket Messages & Bank Card Created! '-'");
    }
}
