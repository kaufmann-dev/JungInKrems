<script>
    import { createEventDispatcher } from 'svelte';
    import { onMount } from 'svelte';
    export let pills = [];
    export let activePill = pills[0];
    const dispatch = createEventDispatcher();

    onMount(() => {
        dispatch('pillsUpdate', activePill);
    });
    
    function handleUpdate(pill) {
        activePill = pill;
        dispatch('pillsUpdate', activePill);
    }
</script>

<style>
    .active {
        background-color: #4a5568;
        color: white;
    }
    @media (hover: hover) {
        button:hover {
            background-color: rgb(229 231 235);
            color: #1f2937;
        }
    }
</style>

<div class="tw-block tw-text-center tw-overflow-auto tw-my-y">
    <nav class="tw-flex tw-gap-3 tw-w-fit tw-m-auto">
        {#each pills as pill}
            <button class:active="{activePill == pill}" on:click={()=>handleUpdate(pill)} class="tw-px-4 tw-py-2 tw-text-sm tw-bg-gray-300 tw-rounded-full tw-text-gray-800 tw-leading-none tw-font-normal">{pill}</button>
        {/each}
    </nav>
</div>