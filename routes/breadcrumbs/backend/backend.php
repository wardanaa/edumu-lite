<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

//Breadcrumbs::for('admin.dashboard.show', function ($trail,$id) {
//    $trail->push('Preview Content', route('admin.dashboard.show',$id));
//});

//Content
Breadcrumbs::for('admin.content', function ($trail) {
    $trail->push(__('Content'), route('admin.content'));
});
Breadcrumbs::for('admin.content.show', function ($trail,$id) {
    $trail->push('Preview Content', route('admin.content.show',$id));
});


//Ebook
Breadcrumbs::for('admin.ebook', function ($trail) {
    $trail->push(__('Ebook'), route('admin.ebook'));
});
Breadcrumbs::for('admin.ebook.shows', function ($trail,$id) {
    $trail->push('Preview Ebook', route('admin.ebook.shows',$id));
});
Breadcrumbs::for('admin.ebook.get_ebook_id', function ($trail,$id) {
    $trail->push('Edit Ebook', route('admin.ebook.get_ebook_id',$id));
});
Breadcrumbs::for('admin.ebook.created_ebook', function ($trail) {
    $trail->push(__('Create'), route('admin.ebook.created_ebook'));
});


//News
Breadcrumbs::for('admin.news', function ($trail) {
    $trail->push(__('News'), route('admin.news'));
});
Breadcrumbs::for('admin.news.look', function ($trail,$id) {
    $trail->push('Preview News', route('admin.news.look',$id));
});
Breadcrumbs::for('admin.news.getid', function ($trail,$id) {
    $trail->push('Edit News', route('admin.news.getid',$id));
});
Breadcrumbs::for('admin.news.create', function ($trail) {
    $trail->push(__('Create'), route('admin.news.create'));
});


//Content Category
Breadcrumbs::for('admin.category', function ($trail) {
    $trail->push(__('Category'), route('admin.category'));
});
Breadcrumbs::for('admin.category.showcategory', function ($trail,$id) {
    $trail->push('Preview Content Category', route('admin.category.showcategory',$id));
});
Breadcrumbs::for('admin.category.getcategoryid', function ($trail,$id) {
    $trail->push('Edit Content Category', route('admin.category.getcategoryid',$id));
});
Breadcrumbs::for('admin.category.created', function ($trail) {
    $trail->push(__('Create Content Category'), route('admin.category.created'));
});


//Customer
Breadcrumbs::for('admin.customer', function ($trail) {
    $trail->push(__('User'), route('admin.customer'));
});
Breadcrumbs::for('admin.customer.showcustomer', function ($trail,$id) {
    $trail->push('Preview User', route('admin.customer.showcustomer',$id));
});
Breadcrumbs::for('admin.customer.get_customer_id', function ($trail,$id) {
    $trail->push('Edit User', route('admin.customer.get_customer_id',$id));
});
Breadcrumbs::for('admin.customer.created_customer', function ($trail) {
    $trail->push(__('Create User'), route('admin.customer.created_customer'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
