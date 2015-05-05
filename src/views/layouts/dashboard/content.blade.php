<!-- Right side column. Contains the navbar and content of the page -->
<aside class="content-wrapper">
<div id='main-container'></div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php $icon = end($breadcrumb)['icon']; ?>

            {{end($breadcrumb)['title']}}
        </h1>
        {{ isset($breadcrumb) ? \Ukadev\Blogfolio\Helpers\Breadcrumbs::create($breadcrumb) : ''; }}
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section><!-- /.content -->
</aside><!-- /.right-side -->