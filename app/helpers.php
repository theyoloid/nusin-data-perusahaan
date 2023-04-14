if (! function_exists('format_idr')) {
function format_idr($value)
{
return 'Rp ' . number_format($value, 0, ',', '.');
}
}