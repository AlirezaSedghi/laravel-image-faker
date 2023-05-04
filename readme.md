<h1 align="center">Laravel Image Faker</h1>

<p align="center">
  <a href="" rel="nofollow"><img alt="Required PHP Version" src="https://img.shields.io/badge/php->=8.0.0-blue?style=flat-square"></a>
  <a href="https://packagist.org/packages/alirezasedghi/laravel-image-faker"><img alt="Total Downloads" src="https://poser.pugx.org/alirezasedghi/laravel-image-faker/downloads?style=flat-square"></a>
  <a href="https://packagist.org/packages/alirezasedghi/laravel-image-faker"><img alt="Latest Stable Version" src="https://poser.pugx.org/alirezasedghi/laravel-image-faker/v/stable?style=flat-square"></a>
  <a href="https://github.com/AlirezaSedghi/laravel-image-faker/releases"><img alt="Latest Stable Version" src="https://img.shields.io/github/v/release/AlirezaSedghi/laravel-image-faker?style=flat-square"></a>
  <a href="https://raw.githubusercontent.com/AlirezaSedghi/laravel-image-faker/master/LICENSE"><img alt="License" src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square"></a>
  <a href="https://github.com/AlirezaSedghi/laravel-image-faker/issues"><img alt="GitHub issues" src="https://img.shields.io/github/issues/AlirezaSedghi/laravel-image-faker.svg?style=flat-square"></a>
</p>

## Description
Laravel Image Faker is an alternative image provider for [FakerPHP](https://github.com/FakerPHP/Faker).

## Installation
```bash
composer require alirezasedghi/laravel-image-faker
```

## Resources
The following sources are utilized by this project to create random images:

- [Lorem Picsum](https://picsum.photos/)
- [LoremFlickr](https://loremflickr.com/)
- [PlaceDog](https://placedog.net/)
- [Kittens (Random Cats) by TheOldReader.com](https://theoldreader.com/kittens/)
- [Fake People by BoredHumans.com](https://boredhumans.com/faces.php)

## Methods
| Code                             | Description                                                                    |
|----------------------------------|--------------------------------------------------------------------------------|
| ``` (new ImageFaker(new Serivce()))->imageUrl() ```   | Return a random image url from the specified service      |
| ``` (new ImageFaker(new Serivce()))->image() ```      | Download a random image from the specified service        |

## Usage
```php
/**
 * Define the model's default state.
 *
 * @return array<string, mixed>
 */
public function definition(): array
{
    /**
     * In order to utilize other services, the following substitutes can be used: 
     *  - new ImageFaker(new LoremFlickr()); 
     *  - new ImageFaker(new PlaceDog()); 
     *  - new ImageFaker(new Kittens()); 
     *  - new ImageFaker(new FakePeople()); 
     */
    $imageFaker = new ImageFaker(new Picsum());
    
    return [
        'title' => $this->faker->sentence(),
        'content' => $this->faker->paragraph(),
        'attachments' => $imageFaker->image( storage_path("app/attachments/") )
    ];
}
```

## Contributing
Don't hesitate to send a PR if you're looking for a service that's not available in this package. 😁

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.
