<script>
    export let data;
    import { createEventDispatcher } from 'svelte';
    const dispatch = createEventDispatcher();
    export let ignore = ['created_at', 'updated_at', 'remember_token'];
    export let isRequest = false;

    function editData(index){
        let event = index;
        dispatch('editData', event);
    }

   function deleteData(index){
        let event = index;
        dispatch('deleteData', event);
    }

    function accept(index){
        let event = index;
        dispatch('accept', event);
    }

    function decline(index){
        let event = index;
        dispatch('decline', event);
    }
</script>

<div class="tw-my-3 tw-block tw-overflow-auto tw-max-w-full">
    <table class="tw-rounded-t-lg tw-overflow-hidden tw-table tw-table-auto tw-bg-gray-100 tw-text-gray-700">
      <thead class="tw-bg-yellow-400 tw-text-white">
        <tr>
          {#each Object.keys(data[0]) as key}
            {#if !ignore.includes(key)}
              <th class="tw-px-2 tw-py-2 tw-font-medium">{key}</th>
            {/if}
          {/each}
          <th></th>
        </tr>
      </thead>
      <tbody>
        {#each data as item, index}
          <tr class={index % 2 === 0 ? 'tw-bg-gray-50' : 'tw-bg-white'}>
            {#each Object.values(item) as value, key}
              {#if !ignore.includes(Object.keys(data[0])[key])}
                <td class="tw-px-2 tw-py-2">{value}</td>
              {/if}
            {/each}
            <td class="tw-px-2 tw-py-2 tw-flex tw-justify-end">
              {#if data[index].Status == 'Offen'}
                <button title="Annehmen" class="tw-mr-2 tw-px-2 tw-py-1 tw-bg-green-500 tw-text-white tw-rounded" on:click={() => accept(index)}><i class="bi bi-check"></i></button>
                <button title="Ablehnen" class="tw-mr-2 tw-px-2 tw-py-1 tw-bg-orange-500 tw-text-white tw-rounded" on:click={() => decline(index)}><i class="bi bi-x"></i></button>
              {/if}
              <button title="Bearbeiten" class="tw-mr-2 tw-px-2 tw-py-1 tw-bg-gray-500 tw-text-white tw-rounded" on:click={() => editData(index)}><i class="bi bi-pencil-square"></i></button>
              <button title="Löschen" class="tw-px-2 tw-py-1 tw-bg-red-500 tw-text-white tw-rounded" on:click={() => deleteData(index)}><i class="bi bi-trash3-fill"></i></button>
            </td>
          </tr>
        {/each}
      </tbody>
    </table>
  </div>