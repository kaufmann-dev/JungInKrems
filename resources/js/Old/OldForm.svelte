<script>
    import SubmitButton from "../Shared/SubmitButton.svelte";
    import DeleteButton from "../Shared/DeleteButton.svelte";
    import CancelButton from "../Shared/CancelButton.svelte";

    export let onSubmit = () => {};;
    export let onDelete = () => {};;
    export let onCancel = () => {};;
    export let newInstance = false;
    export let data;
    export let errors;

    let handleDelete = () => {
        onDelete();
    }

    let handleSubmit = () => {
        onSubmit();
    }

    let handleCancel = () => {
        onCancel();
    }
</script>

<form on:submit|preventDefault={handleSubmit} class="tw-w-full tw-bg-white tw-my-6">
    {#each Object.keys(data) as key}
        {#if key !== 'created_at' && key !== 'updated_at' && key !== 'remember_token'}
            <div class="tw-mb-4">
                <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for={key}>
                    {key}
                </label>
                {#if key == 'STARTING_TIME' || key == 'ENDING_TIME'}
                    <input
                        class="tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={key}
                        type="datetime-local"
                        bind:value={data[key]}
                    />
                {:else if data[key] instanceof Array}
                    <select
                        class="tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={key}
                        type="text"
                        bind:value={data[key]}
                    >
                        {#each data[key] as option}
                            <option value={option}>{option}</option>
                        {/each}
                    </select>
                {:else}
                    <input
                        class="tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={key}
                        type="text"
                        bind:value={data[key]}
                    />
                {/if}
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors[key]}</span>
            </div>
        {/if}
    {/each}
    <SubmitButton>Submit</SubmitButton>
    {#if newInstance === false}
        <div on:click={handleDelete} class="tw-inline-block tw-ms-2">
            <DeleteButton>Delete</DeleteButton>
        </div>
    {/if}
    <div on:click={handleCancel} class="tw-inline-block tw-ms-2">
        <CancelButton>Cancel</CancelButton>
    </div>
</form>