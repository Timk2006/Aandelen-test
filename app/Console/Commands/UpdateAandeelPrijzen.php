<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aandeel;

class UpdateAandeelPrijzen extends Command
{
    /**
     * De naam en signature van de console command.
     */
    protected $signature = 'aandelen:update-prijzen';

    /**
     * De beschrijving van de console command.
     */
    protected $description = 'Update dagelijks de prijzen van alle aandelen met een willekeurige wijziging tussen -10% en +10%';

    /**
     * Voer de command uit.
     */
    public function handle()
    {
        $aandelen = Aandeel::all();
        $aantal = 0;

        foreach ($aandelen as $aandeel) {
            $percentageVerandering = mt_rand(-1000, 1000) / 100; // -10.00 tot +10.00%
            $nieuwePrijs = $aandeel->prijs * (1 + ($percentageVerandering / 100));
            $nieuwePrijs = max(0, round($nieuwePrijs, 2));

            $aandeel->update(['prijs' => $nieuwePrijs]);
            $aantal++;
        }

        $this->info("✅ Aandeelprijzen succesvol bijgewerkt ({$aantal} aandelen).");
    }
}
