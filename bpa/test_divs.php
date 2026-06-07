<?php
foreach(\App\Models\Division::all() as $d) echo $d->id . ' - ' . $d->name . "\n";
