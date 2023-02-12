<script>
    export let data;
    import { createEventDispatcher } from 'svelte';
    const dispatch = createEventDispatcher();

    function editData(index){
        let event = index;
        dispatch('editData', event);
    }

   function deleteData(index){
        let event = index;
        dispatch('deleteData', event);
    }
</script>

<div class="tw-inline-block tw-overflow-auto tw-max-w-full">
    <table class="tw-table tw-table-auto tw-bg-gray-100 tw-text-gray-700">
      <thead class="tw-bg-gray-800 tw-text-white">
        <tr>
          {#each Object.keys(data[0]) as key}
            {#if key !== 'created_at' && key !== 'updated_at' && key !== 'remember_token'}
              <th class="tw-px-2 tw-py-2">{key}</th>
            {/if}
          {/each}
          <th class="tw-px-2 tw-py-2">Aktionen</th>
        </tr>
      </thead>
      <tbody>
        {#each data as item, index}
          <tr class={index % 2 === 0 ? 'tw-bg-gray-50' : 'tw-bg-white'}>
            {#each Object.values(item) as value, key}
              {#if !['created_at', 'updated_at', 'remember_token'].includes(Object.keys(data[0])[key])}
                <td class="tw-px-2 tw-py-2">{value}</td>
              {/if}
            {/each}
            <td class="tw-px-2 tw-py-2 tw-flex tw-justify-between">
              <button class="tw-mr-2 tw-px-2 tw-py-1 tw-bg-blue-500 tw-text-white tw-rounded" on:click={() => editData(index)}>Edit</button>
              <button class="tw-px-2 tw-py-1 tw-bg-red-500 tw-text-white tw-rounded" on:click={() => deleteData(index)}>Delete</button>
            </td>
          </tr>
        {/each}
      </tbody>
    </table>
  </div>