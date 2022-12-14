<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rate;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $rateValue = $request['rate-value'];
        $userId = $request['user_id'];
        $authId = auth()->user()->id;
        // dd($request);

        $veriOrder = Order::whereIn('delivery_id', [$userId, $authId])->whereIn('vendor_id', [$userId, $authId])->exists();
        // dd($veriOrder);

        if ($veriOrder) {
            if (auth()->user()->role === 'vendor') {
                $rateExist = Rate::where('vendor_id', $authId)->where('delivery_id', $userId)->first();
                if ($rateExist) {
                    $rateExist->update([
                        'rate_value_delivery' => $rateValue
                    ]);
                    return redirect()->back()->with('success', 'تم تحديث تقييمك بنجاح');
                } else {
                    Rate::create([
                        'rate_value_delivery' => $rateValue,
                        'vendor_id' => $authId,
                        'delivery_id' => $userId
                    ]);
                    return redirect()->back()->with('success', 'تم إضافة تقييمك بنجاح');
                }
            } else {
                $rateExist = Rate::where('vendor_id', $userId)->where('delivery_id', $authId)->first();
                // dd($rateExist);
                if ($rateExist) {
                    $rateExist->update([
                        'rate_value_vendor' => $rateValue
                    ]);
                    return redirect()->back()->with('success', 'تم تحديث تقييمك بنجاح');
                } else {
                    Rate::create([
                        'rate_value_vendor' => $rateValue,
                        'vendor_id' => $userId,
                        'delivery_id' => $authId
                    ]);
                    return redirect()->back()->with('success', 'تم إضافة تقييمك بنجاح');
                }
            }
        } else {
            return redirect()->back()->with('fail', 'لتقيم هذا الشخص يجب أن يوجد بينكما طلبية');
        }
    }
}
