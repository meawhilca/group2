# index.php – Kinds of Dogs

```php
<!DOCTYPE html>
<html>
<head>
    <title>Kinds of Dogs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .dog-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .dog-card {
            background: white;
            width: 250px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-align: center;
        }

        .dog-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .dog-card h2 {
            color: #444;
        }

        .dog-card p {
            color: #666;
        }
    </style>
</head>
<body>

    <h1>Kinds of Dogs</h1>

    <?php
    $dogs = [
        [
            "name" => "Golden Retriever",
            "image" => "https://images.unsplash.com/photo-1552053831-71594a27632d",
            "description" => "Friendly and intelligent dog breed."
        ],
        [
            "name" => "German Shepherd",
            "image" => "https://images.unsplash.com/photo-1517849845537-4d257902454a",
            "description" => "Loyal and commonly used as police dogs."
        ],
        [
            "name" => "Bulldog",
            "image" => "https://images.unsplash.com/photo-1517423440428-a5a00ad493e8",
            "description" => "Calm and courageous dog breed."
        ]
    ];
    ?>

    <div class="dog-container">
        <?php foreach($dogs as $dog) { ?>
            <div class="dog-card">
                <img src="<?php echo $dog['image']; ?>" alt="Dog Image">
                <h2><?php echo $dog['name']; ?></h2>
                <p><?php echo $dog['description']; ?></p>
            </div>
        <?php } ?>
    </div>

</body>
</html>
```

## How to Run

1. Save the file as `index.php`
2. Put it inside your `htdocs` folder if you are using XAMPP.
3. Start Apache in XAMPP.
4. Open your browser and type:

```text
http://localhost/index.php
```
