<?php

namespace app\Traits;

use Exception;
use Image;

trait FileTrait
{
    public static function picUrl($pic, $imgType, $platform)
    {
        //echo $pic;exit();
        $avatarUrl = config('constants.baseUrl') . config('constants.avatar');
        $avatar = 'no_image.png';
        if ($imgType == 'adminPic') {
            $url = config('constants.baseUrl') . config('constants.adminPic');
            $avatar = 'admin_avatar.png';
        } else if ($imgType == 'profilePic') {
            $url = config('constants.baseUrl') . config('constants.profilePic');
            $avatar = 'admin_avatar.png';
        } else if ($imgType == 'bannerPic') {
            $url = config('constants.baseUrl') . config('constants.bannerPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'bigLogoPic') {
            $url = config('constants.baseUrl') . config('constants.bigLogoPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'smallLogoPic') {
            $url = config('constants.baseUrl') . config('constants.smallLogoPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'favIconPic') {
            $url = config('constants.baseUrl') . config('constants.favIconPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'pujaListPic') {
            $url = config('constants.baseUrl') . config('constants.pujaListPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'pujaImageGalleryPic') {
            $url = config('constants.baseUrl') . config('constants.pujaImageGalleryPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'fireDekhaPic') {
            $url = config('constants.baseUrl') . config('constants.fireDekhaPic');
            $avatar = 'no_image.png';
        } else if ($imgType == 'contestListPic') {
            $url = config('constants.baseUrl') . config('constants.contestListPic');
            $avatar = 'no_image.png';
        } else {
            return false;
        }

        if ($pic != 'NA') {
            if (strpos($pic, 'https') !== false) {
                $picture = $pic;
            } else {
                $picture = $url . $pic;
            }
        } else {
            if ($platform == 'backend') {
                $picture = $avatarUrl . $avatar;
            } elseif ($platform == 'web') {
                $picture = $avatarUrl . $avatar;
            } elseif ($platform == 'app') {
                $picture = $avatarUrl . $avatar;
            } else {
                $picture = 'NA';
            }
        }

        return $picture;
    }

    public function uploadPicture($image, $previousImg, $platform, $imgType)
    {
        try {
            $image = $image;
            $input['imagename'] = md5($image->getClientOriginalName() . microtime()) . "." . $image->getClientOriginalExtension();
            if ($platform == 'backend') {
                if ($imgType == 'adminPic') {
                    $largeWidth = '200';
                    $largeHeight = '200';
                    $largePicPath = config('constants.adminPic');
                    $smallPicPath = '';
                    Image::make($image->getRealPath())->resize($largeWidth, $largeHeight)->save($largePicPath . $input['imagename']);
                } elseif ($imgType == 'bannerPic') {
                    $largePicPath = config('constants.bannerPic');
                    $smallPicPath = '';


                    $image->move($largePicPath, $input['imagename']);

                    // $largeWidth = '640';
                    // $largeHeight = '240';
                    // Image::make($image->getRealPath())->resize($largeWidth, $largeHeight)->save($largePicPath . $input['imagename']);
                } elseif ($imgType == 'bigLogoPic') {
                    $largePicPath = config('constants.bigLogoPic');
                    $smallPicPath = '';
                    $image->move($largePicPath, $input['imagename']);
                } elseif ($imgType == 'smallLogoPic') {
                    $largePicPath = config('constants.smallLogoPic');
                    $smallPicPath = '';
                    $image->move($largePicPath, $input['imagename']);
                } elseif ($imgType == 'favIconPic') {
                    $largePicPath = config('constants.favIconPic');
                    $smallPicPath = '';
                    $image->move($largePicPath, $input['imagename']);
                } elseif ($imgType == 'pujaListPic') {
                    $largePicPath = config('constants.pujaListPic');
                    $smallPicPath = '';
                    $image->move($largePicPath, $input['imagename']);
                } elseif ($imgType == 'pujaImageGalleryPic') {
                    $largePicPath = config('constants.pujaImageGalleryPic');
                    $smallPicPath = '';
                    $image->move($largePicPath, $input['imagename']);
                } elseif ($imgType == 'fireDekhaPic') {
                    $largeWidth = '1920';
                    $largeHeight = '1080';
                    Image::make($image->getRealPath())->resize($largeWidth, $largeHeight)->save($largePicPath . $input['imagename']);

                    // $largePicPath = config('constants.fireDekhaPic');
                    // $smallPicPath = '';
                    // $image->move($largePicPath, $input['imagename']);
                } elseif ($imgType == 'contestListPic') {
                    $largePicPath = config('constants.contestListPic');
                    $smallPicPath = '';
                    $image->move($largePicPath, $input['imagename']);
                } else {
                }
            } elseif ($platform == 'web') {
                if ($imgType == 'customerPic') {
                    $largeWidth = '300';
                    $largeHeight = '300';
                    $largePicPath = config('constants.customerPic');
                    $smallPicPath = '';
                    Image::make($image->getRealPath())->resize($largeWidth, $largeHeight)->save($largePicPath . $input['imagename']);
                }
            }

            if (!empty($previousImg)) {
                if ($previousImg == 'NA') {
                    return $input['imagename'];
                } else {
                    if (unlink($largePicPath . $previousImg)) {
                        if ($smallPicPath != '') {
                            unlink($smallPicPath . $previousImg);
                        }
                        return $input['imagename'];
                    } else {
                        return false;
                    }
                }
            } else {
                return $input['imagename'];
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
