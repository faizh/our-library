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
                        <canvas id="returnTime" height="500px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <span>Bestseller Book</span>
                    </div>
                    <div class="mt-5">
                        <canvas id="best-seller" height="500px"></canvas>
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
    var users =  [{{ $tx_pie->on_time }}, {{ $tx_pie->late }}];
  
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
        options: {
            maintainAspectRatio: false,
        }
      };
  
      const myChart = new Chart(
        document.getElementById('returnTime'),
        config
      );
  
</script>

<script type="text/javascript">
    var labels =  [ <?= '"'.implode('","', $labels).'"' ?>];
    var users =  [ <?= '"'.implode('","', $values).'"' ?>];
  
      const data2 = {
        labels: labels,
        datasets: [{
            label: ['Best Seller'],
            backgroundColor: 'rgba(78, 164, 181)',
            data: users,
        }]
      };
  
      const config2 = {
        type: 'bar',
        data: data2,
        options: {
            maintainAspectRatio: false,
        }
      };
  
      const myChart2 = new Chart(
        document.getElementById('best-seller'),
        config2
      );
  
</script>