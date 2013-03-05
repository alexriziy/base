<?php
namespace Triangulum\WebsiteBundle\Extension;
use Twig_Extension;

class TriangulumTwigExtension extends Twig_Extension
{
    /** @var array $config */
    protected $config;

    /**
     * Get new custom filters
     *
     * @param void
     *
     * @return array of new filters
     */
    public function getFilters() {
        return array(
            'buildImageNode'   => new \Twig_Filter_Function('buildImageNode'),
        );
    }

    /**
     * Get name of custom twig extension
     *
     * @param void
     *
     * @return string name of twig extension
     */
    public function getName()
    {
        return 'triangulum_twig_extension';
    }

    /**
     * Render HTML image tag
     *
     * @param string $imageName
     * @param string $folderPath
     * @param array $scale
     *
     * @return string HTML image tag
     */
    public function buildImageNode($imageName, $folderPath, $scale = array())
    {
        if (empty($this->config['image_path_' . $folderPath])) {
            return '';
        }

        $fullImagePath = '/' . $this->config['image_path_' . $folderPath] . $imageName;
        if (!file_exists($fullImagePath)) {
            return '';
        }

        $width = !empty($scale['width']) ? 'width="' . $scale['width'] . 'px"' : '';
        $height = !empty($scale['height']) ? 'height="' . $scale['height'] . 'px"' : '';

        return '<img src="' . $fullImagePath . '" alt="photo" ' . $width . ' ' . $height . 'title="photo" border="0px"/>';
    }
}
