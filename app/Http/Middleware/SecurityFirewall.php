<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SecurityFirewall
{
    /**
     * Pola Scanner/Bot berbahaya berdasarkan User-Agent
     */
    protected array $badBots = [
        'sqlmap', 'nikto', 'wpscan', 'masscan', 'havij', 'acunetix',
        'dirbuster', 'nmap', 'zgrab', 'censys', 'shodan', 'nessus',
        'openvas', 'arachni', 'qualys', 'appscan'
    ];

    /**
     * Pola serangan URI / Query String berbahaya
     */
    protected array $maliciousUriPatterns = [
        '/\.\.\//i',                             // Directory Traversal (../)
        '/etc\/passwd/i',                        // LFI Linux
        '/etc\/shadow/i',                        // LFI Linux
        '/boot\.ini/i',                          // LFI Windows
        '/proc\/self\/environ/i',                // LFI / Env
        '/php:\/\/input/i',                      // PHP Wrapper RFI
        '/php:\/\/filter/i',                     // PHP Filter Wrapper
        '/<script\b[^>]*>/i',                    // XSS Script tag
        '/javascript\s*:/i',                     // XSS Javascript URI
        '/union\s+(all\s+)?select/i',            // SQLi Union Select
        '/concat\s*\(.*0x/i',                    // SQLi Concat Hex
        '/\b(benchmark|sleep)\s*\(\s*\d+\s*\)/i', // SQLi Time-Based Blind
        '/\b(information_schema|load_file|into\s+outfile|into\s+dumpfile)\b/i', // SQLi Schema & File dumps
        '/base64_decode\s*\(/i',                 // RCE Base64 Decode
        '/eval\s*\(/i',                          // RCE Eval
        '/passthru\s*\(/i',                      // RCE Passthru
        '/shell_exec\s*\(/i',                    // RCE Shell Exec
        '/system\s*\(/i'                         // RCE System
    ];

    /**
     * Handle an incoming request and check against attack signatures.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = strtolower((string)$request->header('User-Agent'));
        $uri = urldecode($request->getRequestUri());
        $ip = $request->ip();

        // 1. Blokir Bad Bots & Vulnerability Scanners
        foreach ($this->badBots as $bot) {
            if (str_contains($userAgent, $bot)) {
                $this->logAttack('BAD_BOT_SCANNER', $ip, $userAgent, $uri);
                return response('403 Forbidden - Akses Ditolak oleh Firewall Sistem.', 403);
            }
        }

        // 2. Blokir Pola Serangan pada URI & Query String
        foreach ($this->maliciousUriPatterns as $pattern) {
            if (preg_match($pattern, $uri)) {
                $this->logAttack('MALICIOUS_URI_ATTACK', $ip, $userAgent, $uri);
                return response('403 Forbidden - Permintaan Ditolak oleh Firewall Sistem.', 403);
            }
        }

        // 3. Blokir Upaya Mengakses File Sensitif Secara Langsung
        $blockedExtensions = ['/\.env/i', '/\.git/i', '/\.htaccess/i', '/\.sql/i', '/\.bak/i', '/composer\.(json|lock)/i', '/package\.(json|lock)/i'];
        foreach ($blockedExtensions as $extPattern) {
            if (preg_match($extPattern, $uri)) {
                $this->logAttack('SENSITIVE_FILE_ACCESS', $ip, $userAgent, $uri);
                return response('403 Forbidden - Akses Dilarang.', 403);
            }
        }

        return $next($request);
    }

    /**
     * Catat log aktivitas serangan untuk pemantauan keamanan
     */
    protected function logAttack(string $type, string $ip, string $userAgent, string $uri): void
    {
        try {
            Log::warning("[SECURITY_FIREWALL_BLOCK] Type: {$type} | IP: {$ip} | URI: {$uri} | UA: {$userAgent}");
        } catch (\Throwable $e) {
            // Abaikan kegagalan log
        }
    }
}
