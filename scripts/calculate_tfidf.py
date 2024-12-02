import json
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Fungsi untuk menghitung TF-IDF dan mendapatkan rekomendasi
def recommend_jobs(user_skills, job_qualifications):
    # Combine user skills and job qualifications
    documents = job_qualifications + [user_skills]

    # Initialize TF-IDF Vectorizer
    vectorizer = TfidfVectorizer()
    tfidf_matrix = vectorizer.fit_transform(documents)

    # Calculate cosine similarity between user skills and each job qualification
    user_vector = tfidf_matrix[-1]  # Last vector corresponds to user skills
    job_vectors = tfidf_matrix[:-1]  # All other vectors correspond to jobs
    similarities = cosine_similarity(user_vector, job_vectors).flatten()

    # Rank jobs by similarity score
    recommendations = sorted(
        [(index, score) for index, score in enumerate(similarities)],
        key=lambda x: x[1],
        reverse=True
    )

    return recommendations

# Contoh Data
if __name__ == "__main__":
    # Input data dari Laravel
    user_skills = "PHP Laravel MySQL"
    job_qualifications = [
        "Bisa menggunakan bahasa pemrograman PHP",
        "Menguasai Python dan AI",
        "Familiar dengan React dan Node.js",
        "Berpengalaman dengan Laravel dan MySQL"
    ]

    # Hitung rekomendasi
    recommendations = recommend_jobs(user_skills, job_qualifications)

    # Hasilkan output berupa indeks pekerjaan dan skor
    print(json.dumps(recommendations))