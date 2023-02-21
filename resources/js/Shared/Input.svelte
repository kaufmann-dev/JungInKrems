<script>
    export let data;
</script>

{#if data.type == "checkbox"}
    <input
        class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
        id={data.bind}
        type="checkbox"
        bind:checked={data.value}
    >
{:else if data.type == "file"}
<input
    class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
    id={data.bind}
    type="file"
    on:input={(e) => {
        data.value = e.target.files[0];
    }}
/>
{:else if data.type == "password"}
    <input
        class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
        id={data.bind}
        type="password"
        bind:value={data.value}
    >
{:else if data.type == "array"}
    <select
        class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
        id={data.bind}
        bind:value={data.value}
    >
        {#each data.options as option}
            <option value={option.value}>{option.name}</option>
        {/each}
    </select>
{:else if data.type == "datetime"}
    <input
        class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
        id={data.bind}
        type="datetime-local"
        bind:value={data.value}
    >
{:else if data.type == "textarea"}
    <textarea
        class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
        id={data.bind}
        bind:value={data.value}
    ></textarea>
{:else}
    <input
        class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
        id={data.bind}
        type="text"
        bind:value={data.value}
    >
{/if}