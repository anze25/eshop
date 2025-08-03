<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_timestamp = Carbon::now()->timestamp;
        $imagePath = public_path('seeders/products');
        $files = File::files($imagePath); // Get all images in folder

        $faker = Faker::create();

        // Fetch existing category and brand IDs
        $categoryIds = Category::pluck('id')->toArray();
        $brandIds = Brand::pluck('id')->toArray();

        $products = [
            'en' => [
                ['name' => 'Classic White Tee', 'short_description' => 'A timeless everyday basic.', 'description' => 'This classic white tee is crafted from soft organic cotton for breathable comfort. Ideal for layering or wearing solo.'],
                ['name' => 'Denim Trucker Jacket', 'short_description' => 'Retro. Rugged. Cool.', 'description' => 'Our vintage-inspired denim trucker jacket features metal buttons and faded wash details for that perfect lived-in look.'],
                ['name' => 'Slim Fit Chinos', 'short_description' => 'Smart-casual made easy.', 'description' => 'These slim-fit chinos are a wardrobe staple, offering stretch comfort with a sharp silhouette that goes from desk to dinner.'],
                ['name' => 'Ribbed Knit Sweater', 'short_description' => 'Cozy without bulk.', 'description' => 'Made from a cotton-wool blend, this ribbed knit pullover offers texture and warmth for colder days without feeling heavy.'],
                ['name' => 'Linen Blend Blazer', 'short_description' => 'Light, tailored, breezy.', 'description' => 'A lightweight linen-blend blazer with a soft structure — perfect for layering over tees or dresses during warm months.'],
                ['name' => 'High-Waisted Trousers', 'short_description' => 'Elegant lines, effortless wear.', 'description' => 'Tailored high-rise trousers with a tapered leg and pleated waist for a flattering silhouette that moves with you.'],
                ['name' => 'Silk Button-Down Shirt', 'short_description' => 'Soft luxury, day to night.', 'description' => 'This silk button-down feels like second skin and elevates any outfit — from business meetings to rooftop dinners.'],
                ['name' => 'Oversized Hoodie', 'short_description' => 'Roomy and relaxed.', 'description' => 'An oversized hoodie made from brushed fleece, built for maximum coziness whether you/re lounging or layering.'],
                ['name' => 'Pleated Midi Skirt', 'short_description' => 'Flowy with a swing.', 'description' => 'A pleated midi skirt with an elastic waistband and subtle sheen, perfect for pairing with boots or sneakers.'],
                ['name' => 'Cargo Jogger Pants', 'short_description' => 'Street style + comfort.', 'description' => 'These joggers combine cargo styling with lightweight stretch fabric for a modern utility-inspired silhouette.'],
                ['name' => 'Puffer Vest', 'short_description' => 'Insulated and lightweight.', 'description' => 'This sleeveless puffer keeps your core warm without the bulk of a full jacket. Great for layering.'],
                ['name' => 'Corduroy Shirt Jacket', 'short_description' => 'Workwear-inspired staple.', 'description' => 'A shirt-meets-jacket silhouette in durable corduroy, perfect for transitional weather.'],
                ['name' => 'Wool Overcoat', 'short_description' => 'Timeless cold-weather classic.', 'description' => 'Crafted in premium wool, this overcoat offers a clean tailored fit and sharp winter layering.'],
                ['name' => 'Canvas Bucket Hat', 'short_description' => 'A casual icon returns.', 'description' => 'The bucket hat is back, made from durable canvas for sun coverage with streetwise appeal.'],
                ['name' => 'Leather Chelsea Boots', 'short_description' => 'Sleek and versatile.', 'description' => 'Italian leather boots with side elastics and pull tab. Dress them up or down with ease.'],
                ['name' => 'Embroidered Sweatshirt', 'short_description' => 'Details make the look.', 'description' => 'A crewneck sweatshirt with minimalist embroidery — soft, cozy, and effortlessly stylish.'],
                ['name' => 'Wrap Front Dress', 'short_description' => 'Feminine and flattering.', 'description' => 'A wrap dress with adjustable fit and flowing hem. Perfect for brunch, dates, or parties.'],
                ['name' => 'Striped Polo Shirt', 'short_description' => 'Sporty and sharp.', 'description' => 'Striped cotton polo with ribbed collar and short sleeves. For casual-cool days.'],
                ['name' => 'Relaxed Fit Shorts', 'short_description' => 'Laid-back summer vibes.', 'description' => 'Breathable cotton shorts with a drawstring waist. Perfect for park hangs and hot weekends.'],
                ['name' => 'Quilted Bomber Jacket', 'short_description' => 'A soft twist on the bomber.', 'description' => 'The quilted texture adds warmth and a bit of visual punch to this classic zip-up silhouette.'],
            ],
            'sl' => [
                ['name' => 'Klasična bela majica', 'short_description' => 'Večna osnova za vsak dan.', 'description' => 'Majica iz organskega bombaža je mehka in zračna. Popolna samostojno ali pod srajco ali jakno.'],
                ['name' => 'Denim jakna', 'short_description' => 'Retro slog z značajem.', 'description' => 'Klasična džins jakna z izprano strukturo in kovinskimi gumbi za udoben, robusten videz.'],
                ['name' => 'Ozke chino hlače', 'short_description' => 'Pametno udobje vsak dan.', 'description' => 'Hlače s slim krojem in rahlo raztegljivostjo – elegantne in udobne za službo ali sproščeno druženje.'],
                ['name' => 'Rebrast pulover', 'short_description' => 'Mehka toplina brez volumna.', 'description' => 'Pulover iz mešanice bombaža in volne, ki vas greje, ne da bi bil težak ali ovirajoč.'],
                ['name' => 'Laneni suknjič', 'short_description' => 'Lahek in zračen sloj.', 'description' => 'Suknjič iz lanene mešanice z mehko strukturo, popoln za pomladne in poletne kombinacije.'],
                ['name' => 'Hlače z visokim pasom', 'short_description' => 'Eleganten kroj z udobjem.', 'description' => 'Hlače z visokim pasom in plisiranimi detajli, ki ustvarijo lep silhuetni učinek.'],
                ['name' => 'Svilena srajca', 'short_description' => 'Gladek luksuz za vsako uro.', 'description' => 'Srajca iz prave svile z gumbi, ki pristaja dnevnim in večernim videzom.'],
                ['name' => 'Prevelika jopa s kapuco', 'short_description' => 'Maksimalno udobje.', 'description' => 'Flisasta jopa s sproščenim krojem, ki vas objame doma, v mestu ali na poti.'],
                ['name' => 'Nagubano midi krilo', 'short_description' => 'Svetleče in lahkotno.', 'description' => 'Midi krilo z gubami in elastiko v pasu — razigrano in vsestransko.'],
                ['name' => 'Cargo jogger hlače', 'short_description' => 'Ulični videz s funkcijo.', 'description' => 'Sodobne cargo hlače iz raztegljivega materiala z žepi in udobno elastiko.'],
                ['name' => 'Prešita brezrokavnica', 'short_description' => 'Topleje, brez teže.', 'description' => 'Brezrokavnica s polnilom vas greje, ne da bi vas omejevala. Popolna za slojenje.'],
                ['name' => 'Žametna srajca', 'short_description' => 'Klasičen kroj z teksturo.', 'description' => 'Srajca iz mehkega žameta v delovnem stilu – idealna za hladnejše dni.'],
                ['name' => 'Volneni plašč', 'short_description' => 'Vrhunska zaščita v zimskem slogu.', 'description' => 'Plašč iz prave volne z elegantnim krojem, ki dopolni vsak zimski videz.'],
                ['name' => 'Platneni klobuk', 'short_description' => 'Ikoničen detajl za sončne dni.', 'description' => 'Klobuk iz trpežnega platna s sproščenim krojem za modno zaščito.'],
                ['name' => 'Usnjeni Chelsea škornji', 'short_description' => 'Čisti linijski eleganca.', 'description' => 'Klasični Chelsea škornji iz pravega usnja, s stranskimi elastikami in zankami za obuvanje.'],
                ['name' => 'Vezen pulover', 'short_description' => 'Nežni detajli, velik učinek.', 'description' => 'Pulover z vezenim vzorcem in udobno bombažno teksturo za vsestranski videz.'],
                ['name' => 'Obleka z zavitim izrezom', 'short_description' => 'Prilagodljiv kroj za vsako priložnost.', 'description' => 'Obleka s preklopnim zgornjim delom in tekočim spodnjim delom — ženstvena in lahkotna.'],
                ['name' => 'Črtasta polo majica', 'short_description' => 'Športna klasika.', 'description' => 'Polo majica iz bombaža s črtastim vzorcem in rebrastim ovratnikom.'],
                ['name' => 'Ohlapne kratke hlače', 'short_description' => 'Sproščeno poletje.', 'description' => 'Lahkotne kratke hlače z vrvico v pasu, udobne za vse dneve na prostem.'],
                ['name' => 'Bomber jakna s prešitjem', 'short_description' => 'Ikoničen kroj z udobjem.', 'description' => 'Prešita bomber jakna z mehkim polnilom in sodobnim krojem.'],
            ],

            'it' => [
                ['name' => 'Maglietta bianca classica', 'short_description' => 'Un capo base irrinunciabile.', 'description' => 'T-shirt in cotone organico morbido e traspirante. Perfetta da sola o sotto una camicia.'],
                ['name' => 'Giacca in denim', 'short_description' => 'Look vintage con carattere.', 'description' => 'Giacca trucker in denim con bottoni in metallo e lavaggio effetto vissuto.'],
                ['name' => 'Chino slim', 'short_description' => 'Eleganza rilassata.', 'description' => 'Pantaloni slim stretch, versatili da ufficio o per il tempo libero.'],
                ['name' => 'Maglione a coste', 'short_description' => 'Calore leggero e comfort.', 'description' => 'Maglione a coste in misto cotone e lana, morbido e traspirante.'],
                ['name' => 'Blazer in lino', 'short_description' => 'Fresco e raffinato.', 'description' => 'Blazer in misto lino leggero, ideale per l’estate o serate eleganti.'],
                ['name' => 'Pantaloni a vita alta', 'short_description' => 'Linea femminile e comoda.', 'description' => 'Pantaloni con vita alta, pinces e taglio affusolato.'],
                ['name' => 'Camicia in seta', 'short_description' => 'Tocco di lusso quotidiano.', 'description' => 'Camicia in seta liscia, perfetta per un look da ufficio o per la sera.'],
                ['name' => 'Felpa oversize con cappuccio', 'short_description' => 'Massimo comfort.', 'description' => 'Felpa morbida in pile con taglio oversize per relax e stile urbano.'],
                ['name' => 'Gonna midi plissettata', 'short_description' => 'Movimento elegante.', 'description' => 'Gonna midi con pieghe fini e fascia elastica in vita.'],
                ['name' => 'Pantaloni cargo jogger', 'short_description' => 'Pratici e trendy.', 'description' => 'Jogger cargo con tasche laterali e tessuto elasticizzato.'],
                ['name' => 'Gilet imbottito', 'short_description' => 'Caldo e leggero.', 'description' => 'Gilet con imbottitura isolante per protezione senza appesantire.'],
                ['name' => 'Giacca in velluto', 'short_description' => 'Morbidezza e stile.', 'description' => 'Giacca stile camicia in velluto con taglio regular.'],
                ['name' => 'Cappotto di lana', 'short_description' => 'Eleganza invernale.', 'description' => 'Cappotto classico in lana con linea pulita e struttura raffinata.'],
                ['name' => 'Cappello bucket in tela', 'short_description' => 'Trend rivisitato.', 'description' => 'Cappello bucket in resistente tela, ideale per il sole urbano.'],
                ['name' => 'Stivaletti Chelsea in pelle', 'short_description' => 'Versatilità moderna.', 'description' => 'Stivaletti in pelle con inserti elastici, design sobrio e di classe.'],
                ['name' => 'Felpa ricamata', 'short_description' => 'Dettagli minimal, stile assicurato.', 'description' => 'Felpa in cotone con ricamo sottile, ideale per outfit semplici ma curati.'],
                ['name' => 'Abito con scollo incrociato', 'short_description' => 'Silhouette femminile e fluida.', 'description' => 'Vestito a portafoglio con cintura regolabile e taglio morbido.'],
                ['name' => 'Polo a righe', 'short_description' => 'Sportiva con classe.', 'description' => 'Maglia polo in cotone con righe sottili e colletto a costine.'],
                ['name' => 'Shorts taglio relaxed', 'short_description' => 'Perfetti per l’estate.', 'description' => 'Pantaloncini in cotone traspirante con coulisse e fit rilassato.'],
                ['name' => 'Bomber trapuntato', 'short_description' => 'Moderno e confortevole.', 'description' => 'Giacca bomber con cuciture a rombi e zip centrale, leggera ma calda.'],
            ],

        ];




        foreach ($files as $index => $file) {
            $fileName = $file->getFilename();

            // Use consistent index to pull product name in English
            $nameEn = $products['en'][$index % count($products['en'])]['name'];
            $slug = Str::slug($nameEn);

            // Check if slug exists
            $existingProduct = Product::where('slug', $slug)->first();
            if ($existingProduct) continue;

            $generatedFileName = $this->GenerateProductThumbnailsImage($file, $fileName);
            $price = $faker->randomFloat(2, 10, 500);

            $productData = [
                'slug' => $slug,
                'image' => $fileName,
                'images' => $fileName,
                'sale_price' => $price * 0.8,
                'regular_price' => $price,
                'SKU' => $faker->unique()->bothify('SKU-####'),
                'featured' => $faker->boolean(),
                'quantity' => $faker->numberBetween(1, 100),
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
            ];

            $translations = [];
            foreach (config('app.supported_locales') as $locale) {
                $productEntry = $products[$locale][$index % count($products[$locale])];

                $translations[$locale] = [
                    'locale' => $locale,
                    'name' => $productEntry['name'],
                    'short_description' => $productEntry['short_description'],
                    'description' => $productEntry['description'],
                ];
            }


            $product = Product::create($productData);
            $product->translations()->createMany($translations);
        }


        echo "Products seeded successfully!";
    }

    private function GenerateProductThumbnailsImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');

        // Ensure directories exist
        File::ensureDirectoryExists($destinationPath);
        File::ensureDirectoryExists($destinationPathThumbnail);

        $img = Image::read($image->getPathname());
        $img->cover(540, 689, 'top');
        $img
            ->resize(540, 689, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath . '/' . $imageName);

        $img
            ->resize(104, 104, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPathThumbnail . '/' . $imageName);
        return;
    }
}
