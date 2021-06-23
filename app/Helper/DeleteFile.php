<?php


namespace App\Helper;

use File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait DeleteFile
{
    /**
     * @param $path
     */
    public static function deleteFile($path)
    {
        File::delete($path);
    }

    /**
     * @param $status
     * @param $model
     * @param $id
     * @return bool
     */
    public static function changeStatus($status, $model, $id):bool
    {
        ( $status == 1 ) ? $status = 0 : $status = 1;

        return ( $model::where('id', $id)->update([
            'status' => $status
        ]) ) ;
    }


    /**
     * @param $model
     * @param $slug
     * @param $column
     * @return string|string[]
     */
    public function createSlug($model, $slug, $column) {
        $slugsFound = static::getSlugs($model,$slug, $column);
        if( $slugsFound == 0 ) $counter = 0;
        else    $counter = (int)$slugsFound + 1;

        $slug = strtolower(str_replace(" ", "", $slug));

        if ($counter) {
            $slug = $slug . '-' . $counter;
        }
        return $slug;
    }


    /**
     * @param $model
     * @param $slug
     * @param $column
     * @return mixed
     */
    public static function getSlugs($model, $slug, $column)
    {
        return  $model::where($column,  strtolower(str_replace(" ", "", $slug)))->count();
    }


    /**
     * @return string[]
     */
    public function fakerText()
    {
        return [
            "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
            "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.",
            "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.. comes from a line in section 1.10.32",
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, s"
        ];
    }


    /**
     * @return string[]
     */
    public function fakerShortText()
    {
        return [
            "It is a long established fact that a reader will be distracted by the",
            "readable content of a page when looking at",
            "There are many variations of passages of Lorem Ipsum",
            "natus error sit voluptatem accusantium doloremque",
            "looked up one of the more obscure Latin words"
        ];
    }


    /**
     * @param UploadedFile $uploadedFile
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return string
     */
    public function uploadImage(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(10) . time() . Str::random(10);

        return ltrim(strstr($uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk), '/'), '/');
    }
}
