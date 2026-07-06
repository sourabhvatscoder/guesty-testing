<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Vacation Map</title>
    <style>
        /* General page styling for presentation */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        /* 1. The Container MUST be set to relative */
        .map-container {
            position: relative;
            max-width: 1200px; /* Adjust based on your website's layout */
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden; /* Keeps neat rounded corners */
        }

        /* 2. The map image scales nicely */
        .map-image {
            width: 100%;
            height: auto;
            display: block;
        }

        /* 3. The secret sauce: Invisible overlays */
        .map-link {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            
            /* Initially invisible */
            background-color: rgba(255, 255, 255, 0); 
            border: 2px solid transparent;
            border-radius: 6px;
            
            /* Smooth transition for the hover effect */
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        /* 4. The Hover Effect (How good it looks) */
        .map-link:hover {
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white highlight */
            border-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transform: scale(1.1); /* Slight pop-out effect */
            z-index: 10;
        }

        /* Optional: Add a little tooltip text on hover */
        .map-link::after {
            content: attr(data-tooltip); /* Pulls text from the HTML tag */
            position: absolute;
            bottom: 110%;
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            opacity: 0;
            white-space: nowrap;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .map-link:hover::after {
            opacity: 1;
        }

        /* =========================================
           POSITIONING THE HOUSES 
           Adjust these percentages to fit perfectly!
           ========================================= */
           
        /* Example: Targeting House #1 near the bottom right */
        #house-1 {
            top: 57%;    /* Distance from top */
            left: 70%; /* Distance from left */
            width: 2%;   /* Width of the clickable box */
            height: 3%;  /* Height of the clickable box */
            background-color: red; /* For debugging: Remove or comment out in production */
        }

        /* Example: Targeting House #28 near Lake Stephanie */
        #house-28 {
            top: 35.5%;
            left: 66.5%;
            width: 2%;
            height: 3%;
        }
        
        /* Example: Targeting House #100 near Lake Olson */
        #house-100 {
            top: 6.5%;
            left: 48%;
            width: 2%;
            height: 3%;
        }
    </style>
</head>
<body>

    <div class="map-container">
        <img src="/test.jpg" alt="Swiss Vacation Houses Map" class="map-image">

        <a href="https://yourwebsite.com/house/1" id="house-1" class="map-link" data-tooltip="View House 1"></a>
        <a href="https://yourwebsite.com/house/28" id="house-28" class="map-link" data-tooltip="View House 28 (Top Tier)"></a>
        <a href="https://yourwebsite.com/house/100" id="house-100" class="map-link" data-tooltip="View House 100 (Luxury)"></a>
    </div>

</body>
</html>