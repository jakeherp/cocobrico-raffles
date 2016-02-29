<?php

use Illuminate\Database\Seeder;

use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Country::truncate();

    	$countries = [
    	 	['id' => 1, 'iso' => 'AF', 'name' => 'Afghanistan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 2, 'iso' => 'AL', 'name' => 'Albania', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 3, 'iso' => 'DZ', 'name' => 'Algeria', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 4, 'iso' => 'AS', 'name' => 'American Samoa', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 5, 'iso' => 'AD', 'name' => 'Andorra', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 6, 'iso' => 'AO', 'name' => 'Angola', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 7, 'iso' => 'AI', 'name' => 'Anguilla', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 9, 'iso' => 'AG', 'name' => 'Antigua and Barbuda', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 10, 'iso' => 'AR', 'name' => 'Argentina', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 11, 'iso' => 'AM', 'name' => 'Armenia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 12, 'iso' => 'AW', 'name' => 'Aruba', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 13, 'iso' => 'AU', 'name' => 'Australia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 14, 'iso' => 'AT', 'name' => 'Austria', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 15, 'iso' => 'AZ', 'name' => 'Azerbaijan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 16, 'iso' => 'BS', 'name' => 'Bahamas', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 17, 'iso' => 'BH', 'name' => 'Bahrain', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 18, 'iso' => 'BD', 'name' => 'Bangladesh', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 19, 'iso' => 'BB', 'name' => 'Barbados', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 20, 'iso' => 'BY', 'name' => 'Belarus', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 21, 'iso' => 'BE', 'name' => 'Belgium', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 22, 'iso' => 'BZ', 'name' => 'Belize', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 23, 'iso' => 'BJ', 'name' => 'Benin', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 24, 'iso' => 'BM', 'name' => 'Bermuda', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 25, 'iso' => 'BT', 'name' => 'Bhutan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 26, 'iso' => 'BO', 'name' => 'Bolivia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 27, 'iso' => 'BA', 'name' => 'Bosnia and Herzegovina', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 28, 'iso' => 'BW', 'name' => 'Botswana', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 29, 'iso' => 'BV', 'name' => 'Bouvet Island', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 30, 'iso' => 'BR', 'name' => 'Brazil', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 31, 'iso' => 'IO', 'name' => 'British Indian Ocean Territory', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 32, 'iso' => 'BN', 'name' => 'Brunei Darussalam', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 33, 'iso' => 'BG', 'name' => 'Bulgaria', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 34, 'iso' => 'BF', 'name' => 'Burkina Faso', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 35, 'iso' => 'BI', 'name' => 'Burundi', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 36, 'iso' => 'KH', 'name' => 'Cambodia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 37, 'iso' => 'CM', 'name' => 'Cameroon', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 38, 'iso' => 'CA', 'name' => 'Canada', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 39, 'iso' => 'CV', 'name' => 'Cape Verde', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 40, 'iso' => 'KY', 'name' => 'Cayman Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 41, 'iso' => 'CF', 'name' => 'Central African Republic', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 42, 'iso' => 'TD', 'name' => 'Chad', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 43, 'iso' => 'CL', 'name' => 'Chile', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 44, 'iso' => 'CN', 'name' => 'China', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 45, 'iso' => 'CX', 'name' => 'Christmas Island', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 46, 'iso' => 'CC', 'name' => 'Cocos (Keeling) Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 47, 'iso' => 'CO', 'name' => 'Colombia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 48, 'iso' => 'KM', 'name' => 'Comoros', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 49, 'iso' => 'CG', 'name' => 'Congo', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 50, 'iso' => 'CD', 'name' => 'Congo, the Democratic Republic of the', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 51, 'iso' => 'CK', 'name' => 'Cook Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 52, 'iso' => 'CR', 'name' => 'Costa Rica', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 53, 'iso' => 'CI', 'name' => 'Cote D\'Ivoire', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 54, 'iso' => 'HR', 'name' => 'Croatia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 55, 'iso' => 'CU', 'name' => 'Cuba', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 56, 'iso' => 'CY', 'name' => 'Cyprus', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 57, 'iso' => 'CZ', 'name' => 'Czech Republic', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 58, 'iso' => 'DK', 'name' => 'Denmark', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 59, 'iso' => 'DJ', 'name' => 'Djibouti', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 60, 'iso' => 'DM', 'name' => 'Dominica', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 61, 'iso' => 'DO', 'name' => 'Dominican Republic', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 62, 'iso' => 'EC', 'name' => 'Ecuador', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 63, 'iso' => 'EG', 'name' => 'Egypt', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 64, 'iso' => 'SV', 'name' => 'El Salvador', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 65, 'iso' => 'GQ', 'name' => 'Equatorial Guinea', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 66, 'iso' => 'ER', 'name' => 'Eritrea', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 67, 'iso' => 'EE', 'name' => 'Estonia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 68, 'iso' => 'ET', 'name' => 'Ethiopia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 69, 'iso' => 'FK', 'name' => 'Falkland Islands (Malvinas)', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 70, 'iso' => 'FO', 'name' => 'Faroe Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 71, 'iso' => 'FJ', 'name' => 'Fiji', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 72, 'iso' => 'FI', 'name' => 'Finland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 73, 'iso' => 'FR', 'name' => 'France', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 74, 'iso' => 'GF', 'name' => 'French Guiana', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 75, 'iso' => 'PF', 'name' => 'French Polynesia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 76, 'iso' => 'TF', 'name' => 'French Southern Territories', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 77, 'iso' => 'GA', 'name' => 'Gabon', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 78, 'iso' => 'GM', 'name' => 'Gambia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 79, 'iso' => 'GE', 'name' => 'Georgia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 80, 'iso' => 'DE', 'name' => 'Germany', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 81, 'iso' => 'GH', 'name' => 'Ghana', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 82, 'iso' => 'GI', 'name' => 'Gibraltar', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 83, 'iso' => 'GR', 'name' => 'Greece', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 84, 'iso' => 'GL', 'name' => 'Greenland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 85, 'iso' => 'GD', 'name' => 'Grenada', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 86, 'iso' => 'GP', 'name' => 'Guadeloupe', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 87, 'iso' => 'GU', 'name' => 'Guam', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 88, 'iso' => 'GT', 'name' => 'Guatemala', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 89, 'iso' => 'GN', 'name' => 'Guinea', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 90, 'iso' => 'GW', 'name' => 'Guinea-Bissau', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 91, 'iso' => 'GY', 'name' => 'Guyana', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 92, 'iso' => 'HT', 'name' => 'Haiti', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 93, 'iso' => 'HM', 'name' => 'Heard Island and Mcdonald Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 94, 'iso' => 'VA', 'name' => 'Holy See (Vatican City State)', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 95, 'iso' => 'HN', 'name' => 'Honduras', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 96, 'iso' => 'HK', 'name' => 'Hong Kong', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 97, 'iso' => 'HU', 'name' => 'Hungary', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 98, 'iso' => 'IS', 'name' => 'Iceland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 99, 'iso' => 'IN', 'name' => 'India', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 100, 'iso' => 'ID', 'name' => 'Indonesia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 101, 'iso' => 'IR', 'name' => 'Iran, Islamic Republic of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 102, 'iso' => 'IQ', 'name' => 'Iraq', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 103, 'iso' => 'IE', 'name' => 'Ireland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 104, 'iso' => 'IL', 'name' => 'Israel', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 105, 'iso' => 'IT', 'name' => 'Italy', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 106, 'iso' => 'JM', 'name' => 'Jamaica', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 107, 'iso' => 'JP', 'name' => 'Japan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 108, 'iso' => 'JO', 'name' => 'Jordan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 109, 'iso' => 'KZ', 'name' => 'Kazakhstan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 110, 'iso' => 'KE', 'name' => 'Kenya', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 111, 'iso' => 'KI', 'name' => 'Kiribati', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 112, 'iso' => 'KP', 'name' => 'Korea, Democratic People\'s Republic of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 113, 'iso' => 'KR', 'name' => 'Korea, Republic of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 114, 'iso' => 'KW', 'name' => 'Kuwait', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 115, 'iso' => 'KG', 'name' => 'Kyrgyzstan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 116, 'iso' => 'LA', 'name' => 'Lao People\'s Democratic Republic', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 117, 'iso' => 'LV', 'name' => 'Latvia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 118, 'iso' => 'LB', 'name' => 'Lebanon', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 119, 'iso' => 'LS', 'name' => 'Lesotho', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 120, 'iso' => 'LR', 'name' => 'Liberia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 121, 'iso' => 'LY', 'name' => 'Libyan Arab Jamahiriya', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 122, 'iso' => 'LI', 'name' => 'Liechtenstein', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 123, 'iso' => 'LT', 'name' => 'Lithuania', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 124, 'iso' => 'LU', 'name' => 'Luxembourg', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 125, 'iso' => 'MO', 'name' => 'Macao', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 126, 'iso' => 'MK', 'name' => 'Macedonia, the Former Yugoslav Republic of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 127, 'iso' => 'MG', 'name' => 'Madagascar', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 128, 'iso' => 'MW', 'name' => 'Malawi', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 129, 'iso' => 'MY', 'name' => 'Malaysia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 130, 'iso' => 'MV', 'name' => 'Maldives', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 131, 'iso' => 'ML', 'name' => 'Mali', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 132, 'iso' => 'MT', 'name' => 'Malta', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 133, 'iso' => 'MH', 'name' => 'Marshall Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 134, 'iso' => 'MQ', 'name' => 'Martinique', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 135, 'iso' => 'MR', 'name' => 'Mauritania', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 136, 'iso' => 'MU', 'name' => 'Mauritius', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 137, 'iso' => 'YT', 'name' => 'Mayotte', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 138, 'iso' => 'MX', 'name' => 'Mexico', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 139, 'iso' => 'FM', 'name' => 'Micronesia, Federated States of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 140, 'iso' => 'MD', 'name' => 'Moldova, Republic of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 141, 'iso' => 'MC', 'name' => 'Monaco', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 142, 'iso' => 'MN', 'name' => 'Mongolia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 143, 'iso' => 'MS', 'name' => 'Montserrat', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 144, 'iso' => 'MA', 'name' => 'Morocco', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 145, 'iso' => 'MZ', 'name' => 'Mozambique', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 146, 'iso' => 'MM', 'name' => 'Myanmar', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 147, 'iso' => 'NA', 'name' => 'Namibia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 148, 'iso' => 'NR', 'name' => 'Nauru', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 149, 'iso' => 'NP', 'name' => 'Nepal', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 150, 'iso' => 'NL', 'name' => 'Netherlands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 151, 'iso' => 'AN', 'name' => 'Netherlands Antilles', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 152, 'iso' => 'NC', 'name' => 'New Caledonia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 153, 'iso' => 'NZ', 'name' => 'New Zealand', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 154, 'iso' => 'NI', 'name' => 'Nicaragua', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 155, 'iso' => 'NE', 'name' => 'Niger', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 156, 'iso' => 'NG', 'name' => 'Nigeria', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 157, 'iso' => 'NU', 'name' => 'Niue', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 158, 'iso' => 'NF', 'name' => 'Norfolk Island', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 159, 'iso' => 'MP', 'name' => 'Northern Mariana Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 160, 'iso' => 'NO', 'name' => 'Norway', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 161, 'iso' => 'OM', 'name' => 'Oman', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 162, 'iso' => 'PK', 'name' => 'Pakistan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 163, 'iso' => 'PW', 'name' => 'Palau', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 164, 'iso' => 'PS', 'name' => 'Palestinian Territory', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 165, 'iso' => 'PA', 'name' => 'Panama', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 166, 'iso' => 'PG', 'name' => 'Papua New Guinea', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 167, 'iso' => 'PY', 'name' => 'Paraguay', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 168, 'iso' => 'PE', 'name' => 'Peru', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 169, 'iso' => 'PH', 'name' => 'Philippines', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 170, 'iso' => 'PN', 'name' => 'Pitcairn', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 171, 'iso' => 'PL', 'name' => 'Poland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 172, 'iso' => 'PT', 'name' => 'Portugal', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 173, 'iso' => 'PR', 'name' => 'Puerto Rico', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 174, 'iso' => 'QA', 'name' => 'Qatar', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 175, 'iso' => 'RE', 'name' => 'Reunion', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 176, 'iso' => 'RO', 'name' => 'Romania', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 177, 'iso' => 'RU', 'name' => 'Russian Federation', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 178, 'iso' => 'RW', 'name' => 'Rwanda', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 179, 'iso' => 'SH', 'name' => 'Saint Helena', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 180, 'iso' => 'KN', 'name' => 'Saint Kitts and Nevis', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 181, 'iso' => 'LC', 'name' => 'Saint Lucia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 182, 'iso' => 'PM', 'name' => 'Saint Pierre and Miquelon', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 183, 'iso' => 'VC', 'name' => 'Saint Vincent and the Grenadines', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 184, 'iso' => 'WS', 'name' => 'Samoa', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 185, 'iso' => 'SM', 'name' => 'San Marino', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 186, 'iso' => 'ST', 'name' => 'Sao Tome and Principe', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 187, 'iso' => 'SA', 'name' => 'Saudi Arabia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 188, 'iso' => 'SN', 'name' => 'Senegal', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 190, 'iso' => 'SC', 'name' => 'Seychelles', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 191, 'iso' => 'SL', 'name' => 'Sierra Leone', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 192, 'iso' => 'SG', 'name' => 'Singapore', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 193, 'iso' => 'SK', 'name' => 'Slovakia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 194, 'iso' => 'SI', 'name' => 'Slovenia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 195, 'iso' => 'SB', 'name' => 'Solomon Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 196, 'iso' => 'SO', 'name' => 'Somalia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 197, 'iso' => 'ZA', 'name' => 'South Africa', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 198, 'iso' => 'GS', 'name' => 'South Georgia and the South Sandwich Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 199, 'iso' => 'ES', 'name' => 'Spain', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 200, 'iso' => 'LK', 'name' => 'Sri Lanka', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 201, 'iso' => 'SD', 'name' => 'Sudan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 202, 'iso' => 'SR', 'name' => 'Suriname', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 203, 'iso' => 'SJ', 'name' => 'Svalbard and Jan Mayen', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 204, 'iso' => 'SZ', 'name' => 'Swaziland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 205, 'iso' => 'SE', 'name' => 'Sweden', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 206, 'iso' => 'CH', 'name' => 'Switzerland', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 207, 'iso' => 'SY', 'name' => 'Syrian Arab Republic', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 208, 'iso' => 'TW', 'name' => 'Taiwan, Province of China', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 209, 'iso' => 'TJ', 'name' => 'Tajikistan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 210, 'iso' => 'TZ', 'name' => 'Tanzania, United Republic of', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 211, 'iso' => 'TH', 'name' => 'Thailand', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 212, 'iso' => 'TL', 'name' => 'Timor-Leste', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 213, 'iso' => 'TG', 'name' => 'Togo', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 214, 'iso' => 'TK', 'name' => 'Tokelau', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 215, 'iso' => 'TO', 'name' => 'Tonga', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 216, 'iso' => 'TT', 'name' => 'Trinidad and Tobago', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 217, 'iso' => 'TN', 'name' => 'Tunisia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 218, 'iso' => 'TR', 'name' => 'Turkey', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 219, 'iso' => 'TM', 'name' => 'Turkmenistan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 220, 'iso' => 'TC', 'name' => 'Turks and Caicos Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 221, 'iso' => 'TV', 'name' => 'Tuvalu', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 222, 'iso' => 'UG', 'name' => 'Uganda', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 223, 'iso' => 'UA', 'name' => 'Ukraine', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 224, 'iso' => 'AE', 'name' => 'United Arab Emirates', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 225, 'iso' => 'GB', 'name' => 'United Kingdom', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 226, 'iso' => 'US', 'name' => 'United States', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 227, 'iso' => 'UM', 'name' => 'United States Minor Outlying Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 228, 'iso' => 'UY', 'name' => 'Uruguay', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 229, 'iso' => 'UZ', 'name' => 'Uzbekistan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 230, 'iso' => 'VU', 'name' => 'Vanuatu', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 231, 'iso' => 'VE', 'name' => 'Venezuela', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 232, 'iso' => 'VN', 'name' => 'Viet Nam', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 233, 'iso' => 'VG', 'name' => 'Virgin Islands, British', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 234, 'iso' => 'VI', 'name' => 'Virgin Islands, U.s.', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 235, 'iso' => 'WF', 'name' => 'Wallis and Futuna', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 236, 'iso' => 'EH', 'name' => 'Western Sahara', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 237, 'iso' => 'YE', 'name' => 'Yemen', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 238, 'iso' => 'ZM', 'name' => 'Zambia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 239, 'iso' => 'ZW', 'name' => 'Zimbabwe', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 240, 'iso' => 'RS', 'name' => 'Serbia', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 242, 'iso' => 'ME', 'name' => 'Montenegro', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 243, 'iso' => 'AX', 'name' => 'Aland Islands', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 244, 'iso' => 'BQ', 'name' => 'Bonaire, Sint Eustatius and Saba', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 245, 'iso' => 'CW', 'name' => 'Curacao', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 246, 'iso' => 'GG', 'name' => 'Guernsey', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 247, 'iso' => 'IM', 'name' => 'Isle of Man', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 248, 'iso' => 'JE', 'name' => 'Jersey', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 249, 'iso' => 'XK', 'name' => 'Kosovo', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 250, 'iso' => 'BL', 'name' => 'Saint Barthelemy', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 251, 'iso' => 'MF', 'name' => 'Saint Martin', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 252, 'iso' => 'SX', 'name' => 'Sint Maarten', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1],
			['id' => 253, 'iso' => 'SS', 'name' => 'South Sudan', 'exclusivity' => 0, 'notificationEmail' => 'info@cocobrico.com', 'active' => 1]
		];

		foreach($countries as $country){
            Country::create($country);
        }
    }
}