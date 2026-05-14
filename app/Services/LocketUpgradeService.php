<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LocketUpgradeService
{
    protected $headers = [
        'Host' => 'api.revenuecat.com',
        'Authorization' => 'Bearer appl_JngFETzdodyLmCREOlwTUtXdQik',
        'Content-Type' => 'application/json',
        'Accept' => '*/*',
        'X-Platform' => 'iOS',
        'X-Platform-Version' => 'Version 26.2 (Build 23C55)',
        'X-Platform-Device' => 'iPhone15,3',
        'X-Platform-Flavor' => 'native',
        'X-Version' => '5.41.0',
        'X-Client-Version' => '2.32.2',
        'X-Client-Bundle-ID' => 'com.locket.Locket',
        'X-Client-Build-Version' => '3',
        'X-StoreKit2-Enabled' => 'true',
        'X-StoreKit-Version' => '2',
        'X-Observer-Mode-Enabled' => 'false',
        'X-Storefront' => 'VNM',
        'X-Apple-Device-Identifier' => '39A73C25-1E05-4350-ADA7-5CD3FE1079E8',
        'X-Preferred-Locales' => 'vi_VN',
        'X-Nonce' => 'w0Mlb6+AmV4WYuVv',
        'X-Is-Backgrounded' => 'false',
        'X-Retry-Count' => '0',
        'X-Is-Debug-Build' => 'false',
        'User-Agent' => 'Locket/3 CFNetwork/3860.300.31 Darwin/25.2.0',
        'Accept-Language' => 'vi-VN,vi;q=0.9',
        'Connection' => 'keep-alive',
        'Pragma' => 'no-cache',
        'Cache-Control' => 'no-cache',
    ];

    protected $tokenSets = [
        [
            'name' => 'V2.41-Set1',
            'fetch_token' => 'eyJhbGciOiJFUzI1NiIsIng1YyI6WyJNSUlFTVRDQ0E3YWdBd0lCQWdJUVI4S0h6ZG41NTRaL1VvcmFkTng5dHpBS0JnZ3Foa2pPUFFRREF6QjFNVVF3UWdZRFZRUURERHRCY0hCc1pTQlhiM0pzWkhkcFpHVWdSR1YyWld4dmNHVnlJRkpsYkdGMGFXOXVjeUJEWlhKMGFXWnBZMkYwYVc5dUlFRjFkR2h2Y21sMGVURUxNQWtHQTFVRUN3d0NSell4RXpBUkJnTlZCQW9NQ2tGd2NHeGxJRWx1WXk0eEN6QUpCZ05WQkFZVEFsVlRNQjRYRFRJMU1Ea3hPVEU1TkRRMU1Wb1hEVEkzTVRBeE16RTNORGN5TTFvd2daSXhRREErQmdOVkJBTU1OMUJ5YjJRZ1JVTkRJRTFoWXlCQmNIQWdVM1J2Y21VZ1lXNWtJR2xVZFc1bGN5QlRkRzl5WlNCU1pXTmxhWEIwSUZOcFoyNXBibWN4TERBcUJnTlZCQXNNSTBGd2NHeGxJRmR2Y214a2QybGtaU0JFWlhabGJHOXdaWElnVW1Wc1lYUnBiMjV6TVJNd0VRWURWUVFLREFwQmNIQnNaU0JKYm1NdU1Rc3dDUVlEVlFRR0V3SlZVekJaTUJNR0J5cUdTTTQ5QWdFR0NDcUdTTTQ5QXdFSEEwSUFCTm5WdmhjdjdpVCs3RXg1dEJNQmdyUXNwSHpJc1hSaTBZeGZlazdsdjh3RW1qL2JIaVd0TndKcWMyQm9IenNRaUVqUDdLRklJS2c0WTh5MC9ueW51QW1qZ2dJSU1JSUNCREFNQmdOVkhSTUJBZjhFQWpBQU1COEdBMVVkSXdRWU1CYUFGRDh2bENOUjAxREptaWc5N2JCODVjK2xrR0taTUhBR0NDc0dBUVVGQndFQkJHUXdZakF0QmdnckJnRUZCUWN3QW9ZaGFIUjBjRG92TDJObGNuUnpMbUZ3Y0d4bExtTnZiUzkzZDJSeVp6WXVaR1Z5TURFR0NDc0dBUVVGQnpBQmhpVm9kSFJ3T2k4dmIyTnpjQzVoY0hCc1pTNWpiMjB2YjJOemNEQXpMWGQzWkhKbk5qQXlNSUlCSGdZRFZSMGdCSUlCRlRDQ0FSRXdnZ0VOQmdvcWhraUc5Mk5rQlFZQk1JSCtNSUhEQmdnckJnRUZCUWNDQWpDQnRneUJzMUpsYkdsaGJtTmxJRzl1SUhSb2FYTWdZMlZ5ZEdsbWFXTmhkR1VnWW5rZ1lXNTVJSEJoY25SNUlHRnpjM1Z0WlhNZ1lXTmpaWEIwWVc1alpTQnZaaUIwYUdVZ2RHaGxiaUJoY0hCc2FXTmhZbXhsSUhOMFlXNWtZWEprSUhSbGNtMXpJR0Z1WkNCamIyNWthWFJwYjI1eklHOW1JSFZ6WlN3Z1kyVnlkR2xtYVdOaGRHVWdjRzlzYVdONUlHRnVaQ0JqWlhKMGFXWnBZMkYwYVc5dUlIQnlZV04wYVdObElITjBZWFJsYldWdWRITXVNRFlHQ0NzR0FRVUZCd0lCRmlwb2RIUnderOi8vYjJOemNDNWhjSEJzWlM1amIyMHZiMk56Y0RBekxXRndjR3hsY205dmRHTmhaek13TndZRFZSMGZCREF3TGpBc29DcWdLSVltYUhRMGNEb3ZMMk55YkM1aGNIQnNaUzVqYjIwdllYQndiR1Z5YjI5MFkyRm5NeTVqY213d0hRWURWUjBPQkJZRUZEOHZsQ05SMDFESm1pZzk3YkI4NWMrbGtHS1pNQTRHQTFVZER3RUIvd1FFQXdJQkJqQVFCZ29xaGtpRzkyTmtCZ0lCQkFJRkFEQUtCZ2dxaGtqT1BRUURBd05vQURCbEFqQkFYaFNxNUl5S29nTUNQdHc0OTBCYUI2NzdDYUVHSlh1ZlFCL0VxWkdkNkNTamlDdE9udU1UYlhWWG14eGN4ZmtDTVFEVFNQeGFyWlh2TnJreFUzVGtVTUkzM3l6dkZWVlJUNHd4V0pDOTk0T3NkY1o0K1JHTnNZRHlSNWdtZHIwbkRHZz0iLCJNSUlURmpDQ0FweWdBd0lCQWdJVUlzR2hSdzAwYzJudlU0WVN5Y2FmUFRqemJOY3dDZ1lJS29aSXpqMEVBd013WnpFYk1Ca0dBMVVFQXd3U1FYQndiR1VnVW05dmRCRFFTQXRJRWN6TVNZd0pBWURWUVFMREIxQmNIQnNaU0JEWlhKMGFXWnBZMkYwYVc5dUlFRjFkR2h2Y21sMGVURVRNQkVHQTFVRUNnd0tRWEJ3YkdVZ1NXNWpMakVMTUFrR0ExVUVCaE1DVlZNd0hoY05NakV3TXpFM01qQXpOekV3V2hjTk16WXdNekU1TURBd01EQXdXakIxTVVRd1FnWURWUVFERER0QmNIQnNaU0JYYjNKc1pIZHBaR1VnUkdWMlpXeHZjR1Z5SUZKbGJHRjBhVzl1Y3lCRFpYSjBhV1pwWTJGMGFXOXVJRUYxZEdodmNtbDBlVEVMTUFrR0ExVUVDd3dDUnpZeEV6QVJCZ05WQkFvTUNrRndjR3hsSubCcmVjdW5SdFpWbWxqWVhScGIyNGdRWFYwYUc5eWFYUjVNUk13RVFZRFZRUUtEQXBCY0hCc1pTQkpibU11TVFzd0NRWURWUVFHRXdKVlV6QjJNQkFHQnlxR1NNNDlBZ0VHQlN1QkJBQWlBMklBQkpqcEx6MUFjcVR0a3lKeWdSTWMzUkNWOGNXalRuSGNGQmJaRHVXbUJTcDNaSHRmVGpqVHV4eEV0WC8xSDdZeVlsM0o2WVJiVHpCUEVWb0EvVmhZREtYMUR5eE5CMGNUZGRxWGw1ZHZNVnp0SzUxN0lEdll1VlRaWHBta09sRUtNYU5DTUVBd0hRWURWUjBPQkJZRUZMdXczcUZZTTRpYXBJcVozcjY5NjYvYXl5U3JNQThHQTFVZEV3RUIvd1FGTUFNQkFmOHdEZ1lEVlIwUEFRSC9CQVFEQWdFR01Bb0dDQ3FHU000OUJBTURBMmdBTUdVQ01RQ0Q2Y0hFRmw0YVhUUVkyZTN2OUd3T0FFWkx1Tit5UmhIRkQvM21lb3locG12T3dnUFVuUFdUeG5TNGF0K3FJeFVDTUcxbWloREsxQTNVVDgyTlF6NjBpbU9sTTI3amJkb1h0MlFmeUZNbStZaGlkRGtMRjF2TFVhZ002QmdENTZLeUtBPT0iXX0.eyJ0cmFuc2FjdGlvbklkIjoiNTUwMDAyOTE1NzMzNjE1Iiwib3JpZ2luYWxUcmFuc2FjdGlvbklkIjoiNTUwMDAyOTE1NzMzNjE1Iiwid2ViT3JkZXJMaW5lSXRlbUlkIjoiNTUwMDAxMjc5NTAwMTI5IiwiYnVuZGxlSWQiOiJjb20ubG9ja2V0LkxvY2tldCIsInByb2R1Y3RJZCI6ImxvY2tldF8xOTlfMW0iLCJzdWJzY3JpcHRpb25Hcm91cElkZW50aWZpZXIiOiIyMTQxOTQ0NyIsInB1cmNoYXNlRGF0ZSI6MTc3Njc1MDA5ODAwMCwib3JpZ2luYWxQdXJjaGFzZURhdGUiOjE3NzY3NTAwOTgwMDAsImV4cGlyZXNEYXRlIjoxNzc5MzQyMDk4MDAwLCJxdWFudGl0eSI6MSwidHlwZSI6IkF1dG8tUmVuZXdhYmxlIFN1YnNjcmlwdGlvbiIsImRldmljZVZlcmlmaWNhdGlvbiI6IlNiWVNYakxFTmprQ0M3VVZtL2k5YytDTFdGMGhaQjFjMkwzYlNLejNwdGV5REtVc0dxQ1lTSzByQmFaalZYMGkiLCJkZXZpY2VWZXJpZmljYXRpb25Ob25jZSI6IjZlZDU5ZjA2LWVmZjItNGIwOS04ZGM5LWM3M2QxOGI5ZThlYSIsImluQXBwT3duZXJzaGlwVHlwZSI6IlBVUkNIQVNFRCIsInNpZ25lZERhdGUiOjE3NzY3NTAxMjM5MDcsImVudmlyb25tZW50IjoiUHJvZHVjdGlvbiIsInRyYW5zYWN0aW9uUmVhc29uIjoiUFVSQ0hBU0UiLCJzdG9yZWZyb250IjoiVk5NIiwic3RvcmVmcm9udElkIjoiMTQzNDcxIiwicHJpY2UiOjQ5MDAwMDAwLCJjdXJyZW5jeSI6IlZORCIsImFwcFRyYW5zYWN0aW9uSWQiOiI3MDU0MDI1OTEwNDA5OTM3MzUifQ.ehfsmoJNkbhnezt6acN1XjXsbHC3GV6SMF3dqVutdycvyUlXrvEIUPK7CsylPous-HrRnJ18VA7vFDTG-WR1iQ',
            'app_transaction' => 'eyJhbGciOiJFUzI1NiIsIng1YyI6WyJNSUlFTVRDQ0E3YWdBd0lCQWdJUVI4S0h6ZG41NTRaL1VvcmFkTng5dHpBS0JnZ3Foa2pPUFFRREF6QjFNVVF3UWdZRFZRUURERHRCY0hCc1pTQlhiM0pzWkhkcFpHVWdSR1YyWld4dmNHVnlJRkpsYkdGMGFXOXVjeUJEWlhKMGFXWnBZMkYwYVc5dUlFRjFkR2h2Y21sMGVURUxNQWtHQTFVRUN3d0NSell4RXpBUkJnTlZCQW9NQ2tGd2NHeGxJRmR2Y214a2QybGtaU0JFWlhabGJHOXdaWElnVW1Wc1lYUnBiMjV6TVJNd0VRWURWUVFLREFwQmNIQnNaU0JKYm1NdU1Rc3dDUVlEVlFRR0V3SlZVekJaTUJNR0J5cUdTTTQ5QWdFR0NDcUdTTTQ5QXdFSEEwSUFCTm5WdmhjdjdpVCs3RXg1dEJNQmdyUXNwSHpJc1hSaTBZeGZlazdsdjh3RW1qL2JIaVd0TndKcWMyQm9IenNRaUVqUDdLRklJS2c0WTh5MC9ueW51QW1qZ2dJSU1JSUNCREFNQmdOVkhSTUJBZjhFQWpBQU1COEdBMVVkSXdRWU1CYUFGRDh2bENOUjAxREptaWc5N2JCODVjK2xrR0taTUhBR0NDc0dBUVVGQndFQkJHUXdZakF0QmdnckJnRUZCUWN3QW9ZaGFIUjBjRG92TDJObGNuUnpMbUZ3Y0d4bExtTnZiUzkzZDJSeVp6WXVaR1Z5TURFR0NDc0dBUVVGQnpBQmhpVm9kSFJ3T2k4dmIyTnpjQzVoY0hCc1pTNWpiMjB2YjJOemNEQXpMWGQzWkhKbk5qQXlNSUlCSGdZRFZSMGdCSUlCRlRDQ0FSRXdnZ0VOQmdvcWhraUc5Mk5rQlFZQk1JSCtNSUhEQmdnckJnRUZCUWNDQWpDQnRneUJzMUpsYkdsaGJtTmxJRzl1SUhSb2FYTWdZMlZ5ZEdsbWFXTmhkR1VnWW5rZ1lXNTVJSEJoY25SNUlHRnpjM1Z0WlhNZ1lXTmpaWEIwWVc1alpTQnZaaUIwYUdVZ2RHaGxiaUJoY0hCc2FXTmhZbXhsSUhOMFlXNWtZWEprSUhSbGNtMXpJR0Z1WkNCamIyNWthWFJwYjI1eklHOW1JSFZ6WlN3Z1kyVnlkR2xtYVdOaGRHVWdjRzlzYVdONUlHRnVaQ0JqWlhKMGFXWnBZMkYwYVc5dUlIQnlZV04wYVdObElITjBZWFJsYldWdWRITXVNRFlHQ0NzR0FRVUZCd0lCRmlwb2RIUnderOi8vYjJOemNDNWhjSEJzWlM1amIyMHZiMk56Y0RBekxXRndjR3hsY205dmRHTmhaek13TndZRFZSMGZCREF3TGpBc29DcWdLSVltYUhRMGNEb3ZMMk55YkM1aGNIQnNaUzVqYjIwdllYQndiR1Z5YjI5MFkyRm5NeTVqY213d0hRWURWUjBPQkJZRUZEOHZsQ05SMDFESm1pZzk3YkI4NWMrbGtHS1pNQTRHQTFVZER3RUIvd1FFQXdJQkJqQVFCZ29xaGtpRzkyTmtCZ0lCQkFJRkFEQUtCZ2dxaGtqT1BRUURBd05vQURCbEFqQkFYaFNxNUl5S29nTUNQdHc0OTBCYUI2NzdDYUVHSlh1ZlFCL0VxWkdkNkNTamlDdE9udU1UYlhWWG14eGN4ZmtDTVFEVFNQeGFyWlh2TnJreFUzVGtVTUkzM3l6dkZWVlJUNHd4V0pDOTk0T3NkY1o0K1JHTnNZRHlSNWdtZHIwbkRHZz0iLCJNSUlURmpDQ0FweWdBd0lCQWdJVUlzR2hSdzAwYzJudlU0WVN5Y2FmUFRqemJOY3dDZ1lJS29aSXpqMEVBd013WnpFYk1Ca0dBMVVFQXd3U1FYQndiR1VnVW05dmRCRFFTQXRJRWN6TVNZd0pBWURWUVFMREIxQmNIQnNaU0JEWlhKMGFXWnBZMkYwYVc5dUlFRjFkR2h2Y21sMGVURVRNQkVHQTFVRUNnd0tRWEJ3YkdVZ1NXNWpMakVMTUFrR0ExVUVCaE1DVlZNd0hoY05NakV3TXpFM01qQXpOekV3V2hjTk16WXdNekU1TURBd01EQXdXakIxTVVRd1FnWURWUVFERER0QmNIQnNaU0JYYjNKc1pIZHBaR1VnUkdWMlpXeHZjR1Z5SUZKbGJHRjBhVzl1Y3lCRFpYSjBhV1pwWTJGMGFXOXVJRUYxZEdodmNtbDBlVEVMTUFrR0ExVUVDd3dDUnpZeEV6QVJCZ05WQkFvTUNrRndjR3hsSubCcmVjdW5SdFpWbWxqWVhScGIyNGdRWFYwYUc5eWFYUjVNUk13RVFZRFZRUUtEQXBCY0hCc1pTQkpibU11TVFzd0NRWURWUVFHRXdKVlV6QjJNQkFHQnlxR1NNNDlBZ0VHQlN1QkJBQWlBMklBQkpqcEx6MUFjcVR0a3lKeWdSTWMzUkNWOGNXalRuSGNGQmJaRHVXbUJTcDNaSHRmVGpqVHV4eEV0WC8xSDdZeVlsM0o2WVJiVHpCUEVWb0EvVmhZREtYMUR5eE5CMGNUZGRxWGw1ZHZNVnp0SzUxN0lEdll1VlRaWHBta09sRUtNYU5DTUVBd0hRWURWUjBPQkJZRUZMdXczcUZZTTRpYXBJcVozcjY5NjYvYXl5U3JNQThHQTFVZEV3RUIvd1FGTUFNQkFmOHdEZ1lEVlIwUEFRSC9CQVFEQWdFR01Bb0dDQ3FHU000OUJBTURBMmdBTUdVQ01RQ0Q2Y0hFRmw0YVhUUVkyZTN2OUd3T0FFWkx1Tit5UmhIRkQvM21lb3locG12T3dnUFVuUFdUeG5TNGF0K3FJeFVDTUcxbWloREsxQTNVVDgyTlF6NjBpbU9sTTI3amJkb1h0MlFmeUZNbStZaGlkRGtMRjF2TFVhZ002QmdENTZLeUtBPT0iXX0.eyJyZWNlaXB0VHlwZSI6IlByb2R1Y3Rpb24iLCJhcHBBcHBsZUlkIjoxNjAwNTI1MDYxLCJidW5kbGVJZCI6ImNvbS5sb2NrZXQuTG9ja2V0IiwiYXBwbGljYXRpb25WZXJzaW9uIjoiMSIsInZlcnNpb25FeHRlcm5hbElkZW50aWZpZXIiOjg4NDExOTAwMCwicmVjZWlwdENyZWF0aW9uRGF0ZSI6MTc3Njc1MDEwNjI4MiwicmVxdWVzdERhdGUiOjE3NzY3NTAxMDYyODIsIm9yaWdpbmFsUHVyY2hhc2VEYXRlIjoxNzExOTAwNzQwNzM1LCJvcmlnaW5hbEFwcGxpY2F0aW9uVmVyc2lvbiI6IjYiLCJkZXZpY2VWZXJpZmljYXRpb24iOiJZVWp6dUN3TExmeVNuYW9Ec2xjWTRqS1dJbmtScFR2ZkxvaWI3ZnB6blZiN0VBWFpHK2J2SDIvV1F6by93b2VlIiwiZGV2aWNlVmVyaWZpY2F0aW9uTm9uY2UiOiJkODhhYmJjNi04ZGI4LTRiMjEtODY0YS05N2RjN2MxMTMxMDEiLCJhcHBUcmFuc2FjdGlvbiI6IjcwNTQwMjU5MTA0MDk5MzczNSIsIm9yaWdpbmFsUGxhdGZvcm0iOiJpT1MifQ.CuybJgEGnY6TPbZE_nuElvgpRc2-KOg7C4SNKmG5KAs5gpgNY6h3B9V6wBK3pLcxK_hrw3NE0ipgGf0huPsaZg',
            'hash_params' => 'app_user_id,fetch_token,app_transaction:sha256:1fa908b2edcf79a8d589bf8103257cddbbf1940a4c612141442a149b19355791',
            'hash_headers' => 'X-Is-Sandbox:sha256:fcbcf165908dd18a9e49f7ff27810176db8e9f63b4352213741664245224f8aa',
            'is_sandbox' => false,
        ],
    ];

    public function resolveUid($username)
    {
        try {
            $response = Http::post("http://127.0.0.1:8888/api/resolve", [
                'username' => $username
            ]);

            Log::info("Locket Engine Resolve Response: " . $response->body());
            if ($response->successful()) {
                $uid = $response->json('uid');
                Log::info("Resolved UID: " . ($uid ?: 'NULL'));
                return $uid;
            }
            return null;
        } catch (\Exception $e) {
            Log::error("Locket Engine Resolve Error: " . $e->getMessage());
            return null;
        }
    }

    protected function extractUid($text)
    {
        if (preg_match('/\/invites\/([A-Za-z0-9]{28})/', $text, $matches)) {
            return $matches[1];
        }
        if (preg_match('/link=([^\\s"\\\'>]+)/', $text, $matches)) {
            $decoded = urldecode($matches[1]);
            if (preg_match('/\/invites\/([A-Za-z0-9]{28})/', $decoded, $innerMatches)) {
                return $innerMatches[1];
            }
        }
        return null;
    }

    public function checkStatus($uid)
    {
        $url = "https://api.revenuecat.com/v1/subscribers/{$uid}";
        try {
            $response = Http::withHeaders($this->headers)->get($url);
            if ($response->successful()) {
                $data = $response->json();
                $entitlements = $data['subscriber']['entitlements']['Gold'] ?? null;
                if ($entitlements) {
                    return [
                        "active" => true,
                        "expires" => $entitlements['expires_date'] ?? 'N/A'
                    ];
                }
            }
            return ["active" => false];
        } catch (\Exception $e) {
            return ["active" => false];
        }
    }

    public function injectGold($uid)
    {
        Log::info("Requesting Locket Engine to inject Gold for UID: {$uid}");
        
        try {
            $response = Http::timeout(60)->post("http://127.0.0.1:8888/api/activate", [
                'uid' => $uid,
                'username' => 'User'
            ]);
            
            Log::info("Locket Engine Activate Response: " . $response->body());
            if ($response->successful()) {
                $data = $response->json();
                if ($data['success']) {
                    return ["success" => true, "expires" => "N/A"];
                }
                return ["success" => false, "message" => "Engine: " . ($data['message'] ?? 'Lỗi không xác định')];
            }
            
            return ["success" => false, "message" => "Không thể kết nối với Bộ máy kích hoạt."];
            
        } catch (\Exception $e) {
            Log::error("Locket Engine Activate Error: " . $e->getMessage());
            return ["success" => false, "message" => "Hệ thống kích hoạt đang bận hoặc gặp lỗi."];
        }
    }

    public function createNextDnsProfile($username = "User")
    {
        $apiKey = env('NEXTDNS_KEY', '8a0cad8a2ed17dc6afc5b91b1c9d143fa69f8802');
        $profileName = "LocketVIP-" . date('Y-m-d');

        try {
            // 1. Check existing
            $listResponse = Http::withHeaders(["X-Api-Key" => $apiKey])->get("https://api.nextdns.io/profiles");
            if ($listResponse->successful()) {
                $profiles = $listResponse->json()['data'] ?? [];
                foreach ($profiles as $p) {
                    if ($p['name'] === $profileName) {
                        $pid = $p['id'];
                        // Double check denylist even if exists
                        Http::withHeaders(["X-Api-Key" => $apiKey])->post("https://api.nextdns.io/profiles/{$pid}/denylist", ["id" => "revenuecat.com", "active" => true]);
                        return [
                            "id" => $pid,
                            "link" => "https://apple.nextdns.io/?profile=" . $pid
                        ];
                    }
                }
            }

            // 2. Create new
            $createResponse = Http::withHeaders(["X-Api-Key" => $apiKey])->post("https://api.nextdns.io/profiles", ["name" => $profileName]);
            if ($createResponse->successful()) {
                $pid = $createResponse->json()['data']['id'];
                
                // Apply Denylist (revenuecat.com and subdomains for safety)
                Http::withHeaders(["X-Api-Key" => $apiKey])->post("https://api.nextdns.io/profiles/{$pid}/denylist", ["id" => "revenuecat.com", "active" => true]);
                Http::withHeaders(["X-Api-Key" => $apiKey])->post("https://api.nextdns.io/profiles/{$pid}/denylist", ["id" => "api.revenuecat.com", "active" => true]);
                
                return [
                    "id" => $pid,
                    "link" => "https://apple.nextdns.io/?profile=" . $pid
                ];
            }
        } catch (\Exception $e) {
            Log::error("NextDNS Error: " . $e->getMessage());
        }

        return null;
    }
}
