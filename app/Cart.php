<?php

namespace App;

use App\Request as BookRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{

    use SoftDeletes;

    public $table = 'cart';
    public $fillable = ['request_id', 'book_id', 'client_id', 'library_id', 'created_at', 'updated_at', 'deleted_at'];

    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    public function library()
    {
        return $this->hasOne(Library::class, 'id', 'library_id');
    }

    public function request()
    {
        return $this->hasOne(BookRequest::class, 'id', 'request_id');
    }


    public static function requests($flag = FALSE)
    {

        $cart = Cart::join('requests', 'requests.id', '=', 'cart.request_id')
            ->where(['requests.client_id' => Auth::id(), 'cart.client_id' => Auth::id()])
            ->select(['requests.*']);
        if ($flag)
            return $cart->get()->toArray();
        return $cart;
    }


    /**
     * calculates the all details about cart's financial
     *
     * @return mixed
     */
    public static function cartTotal()
    {
        $cart = cart_books();
        $sum = 0;
        foreach ($cart as $book) {
            if ($book->getOfferedPrice() != 0)
                $sum += $book->getOfferedPrice();
            else
                $sum += $book->price;
        }
        $data['total_products'] = $sum;
        $data['discount'] = Cart::calculatesDiscountFromTotal($sum);
        $data['final_total'] = $sum - Cart::calculatesDiscountFromTotal($sum);
        return $data;
    }

    public static function checkDelivery($request_id = null)
    {
        $cart = Cart::join('requests', 'requests.id', '=', 'cart.request_id')
            ->where('requests.status', '>=', CONFIRMED)
            ->where(['cart.client_id' => Auth::id()])
            ->where(DB::raw('TIMESTAMPDIFF(MINUTE,requests.confirming_date,requests.created_at)  <= ' . LEGAL_TIME));
        if ($request_id) {
            $cart = $cart->where('requests.id', '=', $request_id)->select(['requests.*'])->get();
            if ($cart->isEmpty())
                return FALSE;
            else
                return TRUE;
        }
        $requestsCount = $cart->select(['requests.*'])->get()->count();
        $cartRequest = cart_requests()->count();
        if ($requestsCount == $cartRequest)
            return TRUE;
        return FALSE;

    }


    /**
     *
     * fetch the summation of promo code's discount
     *
     * @return mixed
     */
    private static function checkPromoCode()
    {
        return PromoCodes::join('client_promocodes', 'client_promocodes.promo_id', '=', 'promocodes.id')
            ->where(['client_id' => Auth::id()])
            ->sum('promocodes.discount_rate');

    }


    /**
     *
     * calculates the discount rate with out subtraction with the whole total
     *
     * @param $total
     * @return float|int
     */
    private static function calculatesDiscountFromTotal($total)
    {
        return (Cart::checkPromoCode() * $total) / 100;
    }

    private function getAvailableFREE_DELIVERY_OFFER()
    {
        return Offer::getAvailableDeliveryDiscountOffer();
    }


}
