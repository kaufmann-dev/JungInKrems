<script>

    import ErrorMessage from './ErrorMessage.svelte';
    import SubmitButton from './SubmitButton.svelte';
    import Input from './Input.svelte';


    let handleSubmit = () => {
        onSubmit();
    }

    function typeAction(node, type) {
        node.type = type;
    }

    /**
     * @typedef {Object} Props
     * @property {any} [onSubmit]
     * @property {any} name
     * @property {string} [additionalError]
     * @property {any} data
     */

    /** @type {Props} */
    let {
        onSubmit = () => {},
        name,
        additionalError = '',
        data
    } = $props();
</script>

<div class=" tw:bg-gray-50 tw:border tw:p-5 tw:rounded-xl">
    <h1 class="tw:mb-5 tw:pb-1.5 tw:border-b tw:border-black">{name}</h1>
    <form onsubmit={(event) => { event.preventDefault(); handleSubmit(); }}>
        {#each data as member}
            <label for={member.bind} class="tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:mb-2">{member.name}</label>
            <div class="tw:mb-4">
                {#if member.type != 'checkbox'}
                    <Input data={member} />
                {:else}
                    <input type="checkbox" name={member.name} id={member.bind} class="tw:shadow-none tw:mt-1 tw:p-2 tw:block tw:w-full tw:border tw:border-gray-300 tw:rounded-md tw:focus:outline-none tw:focus:ring-indigo-500 tw:focus:border-indigo-500 tw:sm:text-sm" bind:checked={member.value}>
                {/if}
                <ErrorMessage>{member.error}</ErrorMessage>
            </div>
        {/each}
        <div class="tw:mt-5">
            <SubmitButton>{name}</SubmitButton>
        </div>
        <ErrorMessage>{additionalError}</ErrorMessage>
    </form>
</div>