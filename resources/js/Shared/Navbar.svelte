<script>
    import Button from './Button.svelte';
    import { inertia, page } from '@inertiajs/svelte';
</script>

<style>
    #navbarImage {
        height: 30px;
    }
</style>

<div class="tw:p-3">
    <nav class="navbar navbar-expand-lg navbar-light tw:bg-gray-50 tw:rounded-lg tw:border">
        <div class="container">
            <a class="tw:cursor-pointer navbar-brand" href={"/"} use:inertia>
                <img id="navbarImage" src="/images/logo.png" alt="The Second Directory logo" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-grow-1 d-flex justify-content-center tw:gap-2">
                    <li class="nav-item">
                        <a href={"/events"} use:inertia class="tw:cursor-pointer nav-link"><i class="bi bi-calendar2-event-fill"></i> Events</a>
                    </li>
                    <li class="nav-item">
                        <a href={"/facilities"} use:inertia class="tw:cursor-pointer nav-link"><i class="bi bi-building-fill"></i> Bildung</a>
                    </li>
                        <li class="nav-item">
                            <a href={"/bookmarks"} use:inertia class="tw:cursor-pointer nav-link"><i class="bi bi-bookmark-fill"></i> Lesezeichen</a>
                        </li>
                </ul>
                {#if !page?.props?.auth?.user}
                    <Button link={"/login"}><i class="bi bi-person-fill"></i> Anmelden</Button>
                {:else}
                <div class="dropdown">
                    <button class="bg-dark btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      {page.props.auth.user.NAME}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="tw:cursor-pointer dropdown-item" href={"/account"} use:inertia><i class="bi bi-person-fill"></i> Account</a></li>
                      <li><a class="tw:cursor-pointer dropdown-item" href={"/newevent"} use:inertia><i class="bi bi-file-earmark-plus-fill"></i> Event anmelden</a></li>
                      {#if page.props.auth.user.ACCOUNT_TYPE == 'Systemverwalter'}
                        <li><a class="tw:cursor-pointer dropdown-item" href={"/dashboard"} use:inertia><i class="bi bi-table"></i> Dashboard</a></li>
                      {/if}
                      <li><hr class="dropdown-divider"></li>
                        <li><a class="tw:cursor-pointer dropdown-item" href={"/logout"} use:inertia><i class="bi bi-box-arrow-right"></i> Abmelden</a></li>
                    </ul>
                  </div>
                {/if}
            </div>
        </div>
    </nav>
</div>