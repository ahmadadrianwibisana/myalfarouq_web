<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Wide Card</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #e0f0ef;
            font-family: Arial, sans-serif;
        }

        .card {
            border-radius: 15px;
            padding: 20px;
            background-color: #b0d4d4;
            width: 900px; /* Increased width for a wider card */
            margin: 20px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card img {
            border-radius: 10px;
            width: 100%; /* Make the image responsive and fit the container */
            height: auto; /* Keep aspect ratio intact */
        }

        .card-title {
            font-size: 2rem; /* Adjusted font size for wider layout */
            font-weight: bold;
            color: #276f5f;
        }

        .card-text {
            font-size: 1.2rem; /* Adjusted font size */
            color: #555;
        }

        .status {
            font-size: 1.3rem; /* Slightly larger font for status */
            font-weight: bold;
            color: #276f5f;
        }

        .btn-danger {
            background-color: #d9534f;
            border: none;
            font-size: 1.1rem;
            padding: 12px 30px; /* Slightly wider padding */
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .info-label {
            font-weight: bold;
            color: #4a4a4a;
        }

        .info-value {
            background-color: #ffffff;
            padding: 6px 12px;
            border-radius: 5px;
            display: inline-block;
            color: #333;
        }

        .info-section {
            margin-bottom: 15px;
        }

        .ket {
            font-size: 1rem;
            color: #4a4a4a;
            font-style: italic;
            line-height: 1.5;
        }

        /* Add some hover effects for the info labels */
        .info-label:hover {
            color: #276f5f;
            cursor: pointer;
        }

        /* Adjust layout for side-by-side info sections */
        .row.custom-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .col-custom {
            flex: 1;
            margin-right: 20px;
        }

        /* Responsive Design for smaller screens */
        @media (max-width: 991px) {
            .card {
                width: 80%; /* Make the card responsive */
            }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="row">
        <div class="col-md-4">
            <img alt="Group of people in front of Petronas Towers" class="img-fluid" src="https://storage.googleapis.com/a1aa/image/UeN1dRgVVYXLYC3rbR1nMNFz9siQuVJ1ztfVQXasWadoVK1TA.jpg"/>
        </div>
        <div class="col-md-8">
            <h5 class="card-title">
                Ahmad Adrian Wibisana
            </h5>
            <p class="card-text">
                085365474309
            </p>
            <p class="card-text">
                <i class="fas fa-users"></i>
                20 Orang
            </p>
            <div class="row custom-row">
                <div class="col-custom">
                    <span class="info-label">Star Point:</span>
                    <span class="info-value">Pekanbaru</span>
                </div>
                <div class="col-custom">
                    <span class="info-label">Destinasi:</span>
                    <span class="info-value">Malaysia - Singapore</span>
                </div>
            </div>
            <div class="row custom-row">
                <div class="col-custom">
                    <span class="info-label">Keberangkatan:</span>
                    <span class="info-value">27/10/2024</span>
                </div>
                <div class="col-custom">
                    <span class="info-label">Kepulangan:</span>
                    <span class="info-value">31/10/2024</span>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <p class="status">
                Status
            </p>
        </div>
        <div class="col-md-10">
            <button class="btn btn-danger">
                Ditolak
            </button>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <p class="status">
                Ket.
            </p>
        </div>
        <div class="col-md-10">
            <p class="ket">
                Tidak bisa berangkat pada tanggal tersebut, silahkan pilih tanggal setelah/sebelum itu dan juga bisa lihat penawaran yang telah tersedia.
            </p>
        </div>
    </div>
</div>

</body>
</html>
