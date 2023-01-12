# mm_json_test
Task: create a CLI script which will read JSON based data. The script will contain several sub-commands to filter and output the loaded data. The commands should be:

* Find objects by price range (given price_from and price_to as arguments).
* Find objects by a certain sub-object definition.

All given sub-commands should only output quantity of objects that are in stock.
For example:

> php run.php count_by_price_range 12.00 145.80
> 
> php run.php count_by_vendor_id 42

Script should be able to work with big json file, and must be at least one unit test.
You should implement interfaces:

```
interface OfferInterface {}
 
interface OfferCollectionInterface {
  public function get(int $index): OfferInterface;
  public function getIterator(): Iterator;
}

interface ReaderInterface {
  public function read(string $input): OfferCollectionInterface;
}
```
