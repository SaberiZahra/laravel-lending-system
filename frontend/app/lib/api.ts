const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

// --- Auth ---
export async function login(login: string, password: string) {
  const res = await fetch(`${API_URL}/login`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ login, password }),
  });

  if (!res.ok) {
    const error = await res.json();
    throw new Error(error.message || "Login failed");
  }

  return res.json();
}

// --- Public Listings (for homepage - no auth needed) ---
export async function getPublicListings() {
  const res = await fetch(`${API_URL}/public/listings`, {
    cache: "no-store",
  });

  if (!res.ok) {
    const error = await res.json();
    throw new Error(error.message || "Failed to fetch listings");
  }

  return res.json();
}

// --- Private Listings (only for logged in user) ---
export async function getMyListings(token: string) {
  const res = await fetch(`${API_URL}/listings`, {
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: "application/json",
    },
    cache: "no-store",
  });

  if (!res.ok) {
    throw new Error("Unauthorized or failed to fetch my listings");
  }

  return res.json();
}

// --- Profile ---
export async function getProfile(token: string) {
  const res = await fetch(`${API_URL}/profile`, {
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: "application/json",
    },
  });

  if (!res.ok) {
    throw new Error("Unauthorized");
  }

  return res.json();
}