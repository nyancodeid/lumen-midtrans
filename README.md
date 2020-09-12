# Midtrans Lumen Example

<a href="https://lumen.laravel.com/docs/7.x"><img src="https://img.shields.io/badge/lumen-v7.2.1-orange" alt="Lumen (v7.2.1)"></a>
<a href="https://github.com/veritrans/veritrans-php"><img src="https://img.shields.io/badge/veritrans%2Fveritrans--php-dev--master-green" alt="Midtrans-PHP (v1.2)"></a>

Example Project How to implement Midtrans with Lumen MicroFramework. **Disclaimer**, this project is for learning purposes only.

## Includes
- Create SNAP Token.
- Check Transaction Status.
- Cancel Transaction.
- MidtransMiddleware.
- Authentication (`not-available`)

## Configuration
Midtrans Configuration is available on `.env` file. And also is ported into config file `configs/app.php` so you can call it using `config` function.

```env
MIDTRANS_MERCH_ID=xxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxx
MIDTRANS_SERVER_KEY=SB-Mid-server-xxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
```

## Routes
| Method | URI             | Action     | Middleware | Map To                                                          |
| ------ | --------------- | ---------- | ---------- | --------------------------------------------------------------- |
| GET    | /               | Closure    |            |                                                                 |
| GET    | /products       | Controller |            | App\Http\Controllers\ProductController@select_view              |
| GET    | /select/{name}  | Controller |            | App\Http\Controllers\MidtransController@create_transaction_view |
| GET    | /tx/status/{id} | Controller | midtrans   | App\Http\Controllers\MidtransController@get_tx_status           |
| POST   | /tx/cancel/{id} | Controller | midtrans   | App\Http\Controllers\MidtransController@cancel_tx               |
| POST   | /tx/create      | Controller | midtrans   | App\Http\Controllers\MidtransController@create_transaction      |
| GET    | /midtrans       | Closure    | midtrans   |                                                                 |
