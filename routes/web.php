<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendCustomerController;
use App\Http\Controllers\Frontend\FrontendHomeController;
use App\Http\Controllers\Frontend\FrontendContactController;
use App\Http\Controllers\Frontend\FrontendOrderController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\SocialMediaLoginController;
use App\Http\Controllers\Frontend\MailController;

use App\Http\Controllers\LocalizationController;

use App\Http\Controllers\Backend\GroupController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\OrderDetailController;
use App\Http\Controllers\Backend\DiscountController;

// //Frontend Or Website

//Add Middleware For Language Change
Route::group(['middleware' => 'changeLangMiddleware'], function () {

    //Login with Github
    Route::get('/social/login/{provider}',[SocialMediaLoginController::class,'socialLogin'])->name('social.login');
    Route::get('/sociallogin/callback',[SocialMediaLoginController::class,'callback'])->name('social.callback');

    //Localization
    Route::get('/change/lang/{lang_name}', [LocalizationController::class, 'changeLang'])->name('change.language');
    
    //Home Page
    Route::get('/', [FrontendHomeController::class, 'frontendHome'])->name('frontend.homepage');

    //Sign-Up & Sign-In For Customer
    Route::get('/sign-up', [FrontendCustomerController::class, 'frontendSignUp'])->name('frontend.sign.up');
    Route::post('/do/sign-up', [FrontendCustomerController::class, 'frontendDoSignup'])->name('frontend.do.sign.up');
    Route::get('/sign-in', [FrontendCustomerController::class, 'frontendSignIn'])->name('frontend.sign.in');
    Route::post('/do/sign-in', [FrontendCustomerController::class, 'frontendDoSignIn'])->name('frontend.do.sign.in');

    //Customer View, Edit & Update
    Route::get('/customer/view', [FrontendCustomerController::class, 'customerView'])->name('customer.view');
    Route::get('/customer/edit', [FrontendCustomerController::class, 'customerEdit'])->name('customer.edit');
    Route::put('/customer/update', [FrontendCustomerController::class, 'customerUpdate'])->name('customer.update');
    
    //All Category Product
    Route::get('/all/category/products', [FrontendProductController::class, 'categoryProduct'])->name('frontend.all.category.products');

    //Single Product
    Route::get('/single/product/{id}', [FrontendProductController::class, 'singleProduct'])->name('frontend.single.product');

    //Cart (View, Add, Update, Clear & Item Delete)
    Route::post('/add-to-cart/{productId}', [FrontendOrderController::class, 'addCart'])->name('frontend.add.to.cart');
    Route::get('/view-cart', [FrontendOrderController::class, 'viewCart'])->name('frontend.view.cart');
    Route::post('/update-cart/{id}', [FrontendOrderController::class, 'updateCart'])->name('frontend.update.cart');
    Route::get('/clear-cart', [FrontendOrderController::class, 'clearCart'])->name('frontend.cart.clear');
    Route::get('/cart/item/delete/{product_id}', [FrontendOrderController::class, 'cartItemDelete'])->name('frontend.cart.item.delete');

    //Checkout & Place Order
    Route::get('/checkout-cart', [FrontendOrderController::class, 'checkoutCart'])->name('checkout.cart');
    Route::post('/place-order', [FrontendOrderController::class, 'placeOrder'])->name('order.place');

    //OTP-One Time Password(Send, Resend & Submit)
    Route::get('/otp', [FrontendCustomerController::class, 'otpPage'])->name('otp.page');
    Route::get('/resend-otp/{email}', [FrontendCustomerController::class, 'otpResend'])->name('otp.resend');
    Route::post('/otp-submit', [FrontendCustomerController::class, 'otpSubmit'])->name('otp.submit');

    //Send Mail For OTP
    Route::get('/send-mail', [MailController::class, 'sendMail'])->name('frontend.send.mail');

    //Middleware For Customer Authentication
    Route::group(['middleware' => 'customerAuth'], function () {

        //Sign-Out For Customer
        Route::get('/sign-out', [FrontendCustomerController::class, 'frontendSignOut'])->name('frontend.sign.out');

        //Contact For Customer
        Route::get('/contact-us', [FrontendContactController::class, 'frontendContactUs'])->name('frontend.contact.us');
    });
});

// //Backend Or Admin Panel

//Add Prefix To All Route
Route::group(['prefix' => 'admin'], function () {

    //Login For Admin
    Route::get('/login', [UserController::class, 'adminLogin'])->name('login');
    Route::post('/do/login', [UserController::class, 'adminDoLogin'])->name('do.login');

    //Add Middleware For Route Permission
    Route::group(['middleware' => ['auth', 'permissionMiddleware']], function () {

        //Logout For Admin
        Route::get('/logout', [UserController::class, 'adminLogout'])->name('logout');

        //Dashboard Or Home
        Route::get('/', [HomeController::class, 'home'])->name('homepage');

        //Group(Index, Create, Edit, Update & Delete)
        Route::get('/group/list', [GroupController::class, 'groupList'])->name('group.list');
        Route::get('get/group/data-table', [GroupController::class, 'ajaxDataTable'])->name('ajax.get.group.data');
        Route::get('/group/form', [GroupController::class, 'groupForm'])->name('group.form');
        Route::post('/submit/group/form', [GroupController::class, 'submitGroupForm'])->name('submit.group.form');

        Route::get('/group/edit/{id}', [GroupController::class, 'groupEdit'])->name('group.edit');
        Route::put('/group/update/{id}', [GroupController::class, 'groupUpadte'])->name('group.update');
        Route::get('/group/delete/{id}', [GroupController::class, 'groupDelete'])->name('group.delete');

        //Category(Index, Create, Edit, Update & Delete)
        Route::get('/category/list', [CategoryController::class, 'categoryList'])->name('category.list');
        Route::get('get/category/data-table', [CategoryController::class, 'ajaxDataTable'])->name('ajax.get.category.data');
        Route::get('/category/form', [CategoryController::class, 'categoryForm'])->name('category.form');
        Route::post('/submit/category/form', [CategoryController::class, 'submitCategoryForm'])->name('submit.category.form');

        Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::put('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

        //Brand(Index, Create, Edit, Update & Delete)
        Route::get('/brand/list', [BrandController::class, 'brandList'])->name('brand.list');
        Route::get('get/brand/data-table', [BrandController::class, 'ajaxDataTable'])->name('ajax.get.brand.data');
        Route::get('/brand/form', [BrandController::class, 'brandForm'])->name('brand.form');
        Route::post('/submit/brand/form', [BrandController::class, 'submitBrandForm'])->name('submit.brand.form');

        Route::get('/brand/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
        Route::put('/brand/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
        Route::get('/brand/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');

        //Product(Index, Create, Edit, Export, Import, View, Update, Delete & Set Alert For Stock)
        Route::get('/product/list', [ProductController::class, 'productList'])->name('product.list');
        Route::get('get/product/data-table', [ProductController::class, 'ajaxDataTable'])->name('ajax.get.product.data');
        Route::get('/product/form', [ProductController::class, 'productForm'])->name('product.form');
        Route::post('/submit/product/form', [ProductController::class, 'SubmitProductForm'])->name('submit.product.form');

        Route::get('/product/export', [ProductController::class, 'productExport'])->name('product.export');
        Route::post('/product/import', [ProductController::class, 'productImport'])->name('product.import');
        
        Route::get('/product/view/{id}', [ProductController::class, 'productView'])->name('product.view');
        Route::get('/product/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::put('/product/update/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
        Route::get('/product/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');

        Route::post('/set-alert-stock', [ProductController::class, 'setAlertStock'])->name('set.alert.stock');

        //Customer(Index & Delete)
        Route::get('/customer/list', [CustomerController::class, 'customerList'])->name('customer.list');
        Route::get('get/customer/data-table', [CustomerController::class, 'ajaxDataTable'])->name('ajax.get.customer.data');

        Route::get('/customer/delete/{id}', [CustomerController::class, 'customerDelete'])->name('customer.delete');

        //Order(Index, Create, Edit, Order Details View, Update & Delete)
        Route::get('/order/list', [OrderController::class, 'orderList'])->name('order.list');
        Route::get('get/order/data-table', [OrderController::class, 'ajaxDataTable'])->name('ajax.get.order.data');
        Route::get('/order/form', [OrderController::class, 'orderForm'])->name('order.form');
        Route::post('/submit/order/form', [OrderController::class, 'SubmitOrderForm'])->name('submit.order.form');

        Route::get('/view/order-details/{id}', [OrderController::class, 'viewOrderDetails'])->name('view.order.details');
        Route::get('/order/edit/{id}', [OrderController::class, 'orderEdit'])->name('order.edit');
        Route::put('/order/update/{id}', [OrderController::class, 'orderUpdate'])->name('order.update');
        Route::get('/order/delete/{id}', [OrderController::class, 'orderDelete'])->name('order.delete');

        //Role
        Route::get('/role/list', [RoleController::class, 'roleList'])->name('role.list');
        Route::get('/role/form', [RoleController::class, 'roleForm'])->name('role.form');
        Route::post('/submit/role/form', [RoleController::class, 'SubmitRoleForm'])->name('submit.role.form');

        Route::get('/role/edit/{id}', [RoleController::class, 'roleEdit'])->name('role.edit');
        Route::put('/role/update/{id}', [RoleController::class, 'roleUpdate'])->name('role.update');
        Route::get('/role/delete/{id}', [RoleController::class, 'roleDelete'])->name('role.delete');

        Route::get('/assign/permission/{id}', [RoleController::class, 'asssignPermission'])->name('role.assign.permission');
        Route::post('store/role/permission', [RoleController::class, 'storePermission'])->name('store.role.permission');

        //User
        Route::get('/user/list', [UserController::class, 'userList'])->name('user.list');
        Route::get('/user/form', [UserController::class, 'userForm'])->name('user.form');
        Route::post('/submit/user/form', [UserController::class, 'SubmitUserForm'])->name('submit.user.form');

        Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('user.edit');
        Route::put('/user/update/{id}', [UserController::class, 'userUpdate'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');

        //Discount
        Route::get('discount/list', [DiscountController::class, 'discountList'])->name('discount.list');
        Route::get('/discount/form', [DiscountController::class, 'discountForm'])->name('discount.form');
        Route::post('/submit/discount/form', [DiscountController::class, 'SubmitDiscountForm'])->name('submit.discount.form');

        Route::get('/discount/edit/{id}', [DiscountController::class, 'discountEdit'])->name('discount.edit');
        Route::put('/discount/update/{id}', [DiscountController::class, 'discountUpdate'])->name('discount.update');
        Route::get('/discount/delete/{id}', [DiscountController::class, 'discountDelete'])->name('discount.delete');
    });
});
