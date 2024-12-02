<?php 
namespace App\Helpers;

class TFIDFHelper
{
    public static function calculateTF($document)
    {
        $terms = str_word_count(strtolower($document), 1);  // Tokenisasi kata
        $tf = array_count_values($terms);  // Menghitung frekuensi kemunculan tiap kata

        // Menormalkan frekuensi kata dengan membagi dengan total kata dalam dokumen
        $totalWords = count($terms);
        foreach ($tf as $term => $count) {
            $tf[$term] = $count / $totalWords;
        }

        return $tf;
    }

    public static function calculateIDF($documents)
    {
        $idf = [];
        $totalDocuments = count($documents);

        // Menghitung IDF untuk setiap kata di semua dokumen
        $allTerms = [];
        foreach ($documents as $document) {
            $terms = array_unique(str_word_count(strtolower($document), 1));  // Ambil kata-kata unik
            $allTerms = array_merge($allTerms, $terms);
        }
        $allTerms = array_unique($allTerms);  // Ambil kata-kata unik di seluruh dokumen

        foreach ($allTerms as $term) {
            $docCount = 0;
            foreach ($documents as $document) {
                if (stripos($document, $term) !== false) {
                    $docCount++;
                }
            }
            // Menghitung IDF
            $idf[$term] = log($totalDocuments / ($docCount + 1)) + 1;
        }

        return $idf;
    }

    public static function calculateTFIDF($tf, $idf)
    {
        $tfidf = [];
        foreach ($tf as $term => $tfValue) {
            $tfidf[$term] = $tfValue * (isset($idf[$term]) ? $idf[$term] : 0);  // TF * IDF
        }
        return $tfidf;
    }

    public static function cosineSimilarity($vectorA, $vectorB)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        // Menghitung dot product dan norma dari vektor A dan B
        foreach ($vectorA as $term => $valueA) {
            if (isset($vectorB[$term])) {
                $dotProduct += $valueA * $vectorB[$term];
            }
            $normA += $valueA * $valueA;
        }

        foreach ($vectorB as $valueB) {
            $normB += $valueB * $valueB;
        }

        $normA = sqrt($normA);
        $normB = sqrt($normB);

        // Menghitung cosine similarity
        return ($dotProduct / ($normA * $normB)) ?? 0;
    }
}
