<?php

    function lastPrice($typePrice, $marketId, $commodityId) {
        $commodity = \DB::table('commodity_prices')->where('type_price_id', $typePrice)
            ->where('market_id', $marketId)->where('commodity_id', $commodityId)->orderBy('id', 'DESC')->first();
        if ($commodity) {
            return $commodity->price;
        } else {
            return '0';
        }
    }

    function secondPrice($typePrice, $marketId, $commodityId)
    {
        $current = DB::table('commodity_prices')
            ->where('type_price_id', $typePrice)
            ->where('market_id', $marketId)
            ->where('commodity_id', $commodityId)
            ->orderBy('id', 'DESC')->first();

        if ($current) {
            $old = DB::table('commodity_prices')
                ->where('type_price_id', $typePrice)
                ->where('market_id', $marketId)
                ->where('commodity_id', $commodityId)
                ->where('id', '<', $current->id)
                ->latest('id')
                ->first();
            return $old->price;
        } else {
            return '0';
        }
    }

    function getGap($old, $new)
    {
        if ($old === $new) {
            return '<i class="fa fa-minus text-default m-r-5"></i>0';
        } elseif ($old < $new) {
            return '<i class="fa fa-caret-up text-danger m-r-5"></i>' . ($new - $old);
        } else {
            return '<i class="fa fa-caret-down text-danger m-r-5"></i>' . ($new + $old);
        }
    }