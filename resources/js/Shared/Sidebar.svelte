<script>
  import { page, inertia } from '@inertiajs/svelte';
</script>

<div class="tw-shrink-0 tw-w-64 tw-bg-gray-50 tw-border tw-rounded-lg tw-overflow-hidden">
  <div class="tw-bg-gray-200 tw-p-4 tw-text-center tw-relative">
      <span use:inertia="{{ href: "/dashboard", method: 'get' }}" class="tw-cursor-pointer tw-text-lg tw-font-medium tw-text-gray-700">Dashboard</span>
  </div>
  <nav class="tw-flex-grow tw-overflow-y-auto tw-divide-y">
      <span use:inertia="{{ href: "/dashboard/accounts", method: 'get' }}" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-block tw-px-4 tw-py-3 tw-text-base tw-font-medium tw-text-gray-700 tw-transition-all duration-150">
          Accounts
      </span>
      <span use:inertia="{{ href: "/dashboard/events", method: 'get' }}" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-block tw-px-4 tw-py-3 tw-text-base tw-font-medium tw-text-gray-700 tw-transition-all duration-150">
          Events
      </span>
      <span use:inertia="{{ href: "/dashboard/facilities", method: 'get' }}" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-block tw-px-4 tw-py-3 tw-text-base tw-font-medium tw-text-gray-700 tw-transition-all duration-150">
          Facilities
      </span>
      <span use:inertia="{{ href: "/dashboard/requests", method: 'get' }}" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-block tw-px-4 tw-py-3 tw-text-base tw-font-medium tw-text-gray-700 tw-transition-all duration-150">
          Requests
      </span>
  </nav>
</div>

<!-- <div class="d-flex flex-column flex-shrink-0 p-3 bg-light border rounded" style="width: 280px;">
  <span use:inertia="{{ href: "/new", method: 'get' }}" class="tw-cursor-pointer link-dark text-decoration-none">
    <span class="fs-4">Dashboard</span>
  </span>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="#" class="nav-link active" aria-current="page">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
        Accounts
      </a>
    </li>
    <li>
      <a href="#" class="nav-link link-dark">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
        Events
      </a>
    </li>
    <li>
      <a href="#" class="nav-link link-dark">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
        Facilities
      </a>
    </li>
    <li>
      <a href="#" class="nav-link link-dark">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
        Requests
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong>mdo</strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
      <li><a class="dropdown-item" href="#">New project...</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Sign out</a></li>
    </ul>
  </div>
</div> -->