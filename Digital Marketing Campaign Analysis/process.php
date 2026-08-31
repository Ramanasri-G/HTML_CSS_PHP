<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Campaign data stored in an array
    $campaignData = [
        "Campaign" => $_POST["campaign"],
        "Impressions" => (int)$_POST["impressions"],
        "Clicks" => (int)$_POST["clicks"],
        "Conversions" => (int)$_POST["conversions"],
        "Cost" => (float)$_POST["cost"],
        "Revenue" => (float)$_POST["revenue"]
    ];

    // Extract values
    $impressions = $campaignData["Impressions"];
    $clicks = $campaignData["Clicks"];
    $conversions = $campaignData["Conversions"];
    $cost = $campaignData["Cost"];
    $revenue = $campaignData["Revenue"];

    // Calculate KPIs

    // Click Through Rate
    $ctr = ($impressions > 0)
        ? ($clicks / $impressions) * 100
        : 0;

    // Conversion Rate
    $conversionRate = ($clicks > 0)
        ? ($conversions / $clicks) * 100
        : 0;

    // Cost Per Click
    $cpc = ($clicks > 0)
        ? $cost / $clicks
        : 0;

    // Cost Per Conversion
    $costPerConversion = ($conversions > 0)
        ? $cost / $conversions
        : 0;

    // Return On Investment
    $roi = ($cost > 0)
        ? (($revenue - $cost) / $cost) * 100
        : 0;

    // Return On Ad Spend
    $roas = ($cost > 0)
        ? $revenue / $cost
        : 0;


    // Performance status
    if ($roi >= 50) {
        $performance = "Excellent";
    } elseif ($roi >= 20) {
        $performance = "Good";
    } elseif ($roi >= 0) {
        $performance = "Average";
    } else {
        $performance = "Needs Improvement";
    }

} else {

    header("Location: index.html");
    exit();

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Campaign Analysis Report</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .report {
            width: 850px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .report h1 {
            text-align: center;
            color: #4527a0;
            margin-bottom: 25px;
        }

        .campaign-name {
            background: #ede7f6;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .kpi-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .kpi {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .kpi h3 {
            color: #4527a0;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .kpi p {
            color: #333;
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        h2 {
            color: #4527a0;
            margin: 25px 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #4527a0;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f5f5f5;
        }

        .performance {
            text-align: center;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            margin-top: 25px;
        }

        .back {
            display: block;
            width: 250px;
            margin: 25px auto 0;
            padding: 12px;
            background: #4527a0;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 7px;
        }

        .back:hover {
            background: #311b92;
        }

    </style>

</head>

<body>

<div class="report">

    <h1>Digital Marketing Campaign Report</h1>

    <div class="campaign-name">
        Campaign:
        <?php echo htmlspecialchars($campaignData["Campaign"]); ?>
    </div>


    <!-- KPI Cards -->

    <div class="kpi-container">

        <div class="kpi">
            <h3>Click Through Rate</h3>
            <p><?php echo number_format($ctr, 2); ?>%</p>
        </div>

        <div class="kpi">
            <h3>Conversion Rate</h3>
            <p><?php echo number_format($conversionRate, 2); ?>%</p>
        </div>

        <div class="kpi">
            <h3>Cost Per Click</h3>
            <p>₹<?php echo number_format($cpc, 2); ?></p>
        </div>

        <div class="kpi">
            <h3>Cost Per Conversion</h3>
            <p>₹<?php echo number_format($costPerConversion, 2); ?></p>
        </div>

        <div class="kpi">
            <h3>ROI</h3>
            <p><?php echo number_format($roi, 2); ?>%</p>
        </div>

        <div class="kpi">
            <h3>ROAS</h3>
            <p><?php echo number_format($roas, 2); ?>x</p>
        </div>

    </div>


    <!-- Campaign Summary -->

    <h2>Campaign Summary</h2>

    <table>

        <tr>
            <th>Metric</th>
            <th>Value</th>
        </tr>

        <tr>
            <td>Impressions</td>
            <td><?php echo number_format($impressions); ?></td>
        </tr>

        <tr>
            <td>Clicks</td>
            <td><?php echo number_format($clicks); ?></td>
        </tr>

        <tr>
            <td>Conversions</td>
            <td><?php echo number_format($conversions); ?></td>
        </tr>

        <tr>
            <td>Campaign Cost</td>
            <td>₹<?php echo number_format($cost, 2); ?></td>
        </tr>

        <tr>
            <td>Revenue</td>
            <td>₹<?php echo number_format($revenue, 2); ?></td>
        </tr>

    </table>


    <div class="performance">
        Campaign Performance:
        <?php echo $performance; ?>
    </div>


    <a href="index.html" class="back">
        Analyze Another Campaign
    </a>

</div>

</body>
</html>