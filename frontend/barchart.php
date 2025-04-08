<!-- BAR CHART


<!-- <!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Bar Graph</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .chart-container {
            
            width: 400px;
            height: 300px;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            border: 1px solid black;
            margin: 20px auto;
            padding-bottom: 10px;
        }
        .bar {
            width: 50px;
            background-color: green;
            transition: height 0.3s;
        }
        .yellow { background-color: yellow; }
        .red { background-color: red; }
    </style>
</head>
<body>
    <h2 style="margin-top: 300px;">Dashboard Representation Graph</h2>
    <div class="chart-container">
        <div class="bar" id="addressed" style="height: 70px;"></div>
        <div class="bar yellow" id="pending" style="height: 50px;"></div>
        <div class="bar red" id="expired" style="height: 20px;"></div>
    </div>
    
    <button onclick="increaseBar('addressed')">Increase Addressed</button>
    <button onclick="decreaseBar('expired')">Decrease Expired</button>
    
    <script>
        function increaseBar(id) {
            let bar = document.getElementById(id);
            let currentHeight = parseInt(bar.style.height);
            if (currentHeight < 280) {
                bar.style.height = (currentHeight + 10) + 'px';
            }
        }
        
        function decreaseBar(id) {
            let bar = document.getElementById(id);
            let currentHeight = parseInt(bar.style.height);
            if (currentHeight > 10) {
                bar.style.height = (currentHeight - 10) + 'px';
            }
        }
    </script>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dynamic Bars</title>
    <style>
        .bar-container {
            display: flex;
            align-items: flex-end;
            gap: 40px;
            height: 300px;
            border-left: 2px solid black;
            border-bottom: 2px solid black;
            padding: 10px;
        }
        .bar {
            width: 60px;
            text-align: center;
            color: white;
            transition: height 0.5s ease;
        }
        .addressed { background: #2E7D32; }
        .pending { background: #FFEB3B; color: black; }
        .expired { background: #F44336; }
    </style>
</head>
<body>
    <h2>Dashboard Representation Graph</h2>
    <div class="bar-container" id="chart">
        <div class="bar addressed" id="addressedBar">0</div>
        <div class="bar pending" id="pendingBar">0</div>
        <div class="bar expired" id="expiredBar">0</div>
    </div>

    <script>
        // Function to update a bar's height and value
        function updateBar(barId, value) {
            const bar = document.getElementById(barId);
            bar.style.height = `${value * 3}px`; // Adjust multiplier for scaling
            bar.textContent = value;
        }

        // Example values (Replace these with PHP dynamic data)
        let addressed = 70;
        let pending = 30;
        let expired = 10;

        // Update bars
        updateBar('addressedBar', addressed);
        updateBar('pendingBar', pending);
        updateBar('expiredBar', expired);

        // Simulate live update (for testing only)
        // setInterval(() => {
        //     addressed += 1; // Increment values
        //     pending += 2;
        //     expired += 0;

        //     updateBar('addressedBar', addressed);
        //     updateBar('pendingBar', pending);
        //     updateBar('expiredBar', expired);
        // }, 6000); // Update every 5 seconds

    </script>
</body>
</html> -->
