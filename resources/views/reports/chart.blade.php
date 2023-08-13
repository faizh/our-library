<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports / Charts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <span>Book's Return Time</span>
                    </div>
                    <div class="mt-5">
                        <canvas id="myChart" height="100px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
    var labels =  ["On Time", "Late"];
    var users =  [{{ $tx->on_time }}, {{ $tx->late }}];
  
      const data = {
        labels: labels,
        datasets: [{
            label: ['Return Time'],
            backgroundColor: [
                'rgba(76, 140, 79)',
                'rgba(255, 159, 64)'
            ],
            data: users,
        }]
      };
  
      const config = {
        type: 'pie',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  
</script>