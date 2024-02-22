<?php
namespace App\Helpers;

use FilesystemIterator;
use Illuminate\Support\Facades\Storage;

class QueueLib
{
    /*
     * Add a queue
     * bucket: bucket name (eg: test) will be created under storage/app/private/queue/
     * $queueData: array|object|string will be written in the queue
     * $priority: int (1-9) lower value will be retrieve first
     * example: QueueLib::push('test', $stringArrayObject, 4);
     * returns nothing
     */
    public static function push($bucket, $queueData, $priority=6)
    {
        $priority = getInt($priority);
        if($priority <0 || $priority > 9) // 1-9 (0 is reserved for emergency ie: send instant email)
            $priority = 6;

        $meta['priority'] = $priority;
        $meta['timestamp'] = time();
        $meta['key'] = $priority.'_'.$meta['timestamp'].'_'.str_replace('0.', '', explode(' ', microtime())[0]) . '_' . mt_rand(1000, 9999);

        $write['meta'] = $meta;
        $write['data'] = $queueData;

        $queueFile = $bucket.'/'.$meta['key'];
        $write = serialize($write);

        Storage::disk('queue')->put($queueFile, $write);
    }

    /*
     * Read a queue
     * bucket: bucket name (eg: test) which was created under cache/queue/test OR in redis list
     * example: QueueLib::pull('test');
     * read queue will be deleted by default
     * @params $delete bool (set false to not delete the queue, helpful while debugging)
     * @returns a single queue as array with 'meta' and 'data' key
     */
    public static function pull($bucket, $delete=true)
    {
        $queueDir = storage_path('app/private/queue/'.$bucket);
        $queueContent = [];

        if (file_exists($queueDir))
        {
            $files = scandir($queueDir);
            if (isset($files[2]))
            {
                $queueKey = $files[2]; // 0=. | 1=..
                $queueContent = unserialize(file_get_contents($queueDir.'/'.$queueKey));

                if($delete)
                    unlink($queueDir.'/'.$queueKey);
            }
        }

        return $queueContent;
    }

    /*
     * Count queue
     * Ex: QueueLib::count('silentAccount');
     */
    public static function count($bucket): int
    {
        $bucketDir = storage_path('app/private/queue/'.$bucket);

        if(file_exists($bucketDir))
        {
            $fi = new FilesystemIterator($bucketDir, FilesystemIterator::SKIP_DOTS);
            return iterator_count($fi);
        }
        return 0;
    }


}
?>
